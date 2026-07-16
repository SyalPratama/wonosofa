<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductPhoto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class KelolaProductController extends Controller
{
    /**
     * Folder penyimpanan foto produk yang diupload lewat admin,
     * relatif terhadap /public.
     */
    protected const UPLOAD_PATH = 'assets/img/products';

    /**
     * Tampilkan daftar produk.
     */
    public function index()
    {
        $products = Product::with(['colors', 'photos', 'primaryPhoto', 'dimension', 'shippingAndReturn'])
            ->latest()
            ->paginate(10);

        // Semua warna yang sudah ada (master data), supaya bisa dipilih ulang
        // saat menambah warna ke produk lain.
        $availableColors = Color::orderBy('name')->get();

        return view('admin.products', compact('products', 'availableColors'));
    }

    /**
     * Simpan produk baru beserta warna, foto, dimensi, dan shipping/return.
     */
    public function store(Request $request)
    {
        $validated = $this->validateProduct($request);

        $product = Product::create([
            'name'        => $validated['name'],
            'sku'         => $validated['sku'] ?? null,
            'description' => $validated['description'] ?? null,
            'material'    => $validated['material'] ?? null,
            'price'       => $validated['price'],
            'stock'       => $validated['stock'],
            'is_active'   => $request->boolean('is_active'),
        ]);

        $this->syncColors($product, $request->input('colors', []));
        $this->storeNewPhotos($product, $request, $this->resolveNewPrimaryIndex($request));
        $this->syncDimension($product, $validated);
        $this->syncShippingAndReturn($product, $validated);

        return redirect()
            ->route('admin.produk.index')
            ->with('status', "Produk \"{$product->name}\" berhasil ditambahkan.");
    }

    /**
     * Update produk, warna, foto, dimensi, dan shipping/return yang sudah ada.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $this->validateProduct($request, $product);

        $product->update([
            'name'        => $validated['name'],
            'sku'         => $validated['sku'] ?? null,
            'description' => $validated['description'] ?? null,
            'material'    => $validated['material'] ?? null,
            'price'       => $validated['price'],
            'stock'       => $validated['stock'],
            'is_active'   => $request->boolean('is_active'),
        ]);

        $this->syncColors($product, $request->input('colors', []));
        $this->deletePhotos($product, $request->input('delete_photos', []));

        $primaryPhoto    = $request->input('primary_photo');
        $newPrimaryIndex = $this->resolveNewPrimaryIndex($request);

        // Kalau yang dipilih sebagai utama adalah foto lama (bukan foto baru),
        // set primary-nya di sini. Kalau yang dipilih foto baru, biar
        // storeNewPhotos() yang menentukan setelah file selesai diupload.
        if ($primaryPhoto && $newPrimaryIndex === null) {
            $this->updatePrimaryPhoto($product, $primaryPhoto);
        }

        $this->storeNewPhotos($product, $request, $newPrimaryIndex);
        $this->syncDimension($product, $validated);
        $this->syncShippingAndReturn($product, $validated);

        return redirect()
            ->route('admin.produk.index')
            ->with('status', "Produk \"{$product->name}\" berhasil diperbarui.");
    }

    /**
     * Hapus produk beserta warna, foto, dimensi, dan shipping/return
     * (termasuk file fisik foto). Data terkait ikut terhapus lewat cascade di database.
     */
    public function destroy(Product $product)
    {
        foreach ($product->photos as $photo) {
            $this->deletePhotoFile($photo->file_name);
        }

        $name = $product->name;
        $product->delete();

        return redirect()
            ->route('admin.produk.index')
            ->with('status', "Produk \"{$name}\" berhasil dihapus.");
    }

    /**
     * Validasi input produk. Dipakai bersama untuk store & update.
     */
    protected function validateProduct(Request $request, ?Product $product = null): array
    {
        return $request->validate([
            'name'                  => ['required', 'string', 'max:255'],
            'sku'                   => [
                'nullable', 'string', 'max:100',
                'unique:products,sku' . ($product ? ',' . $product->id : ''),
            ],
            'material'              => ['nullable', 'string', 'max:255'],
            'description'           => ['nullable', 'string'],
            'price'                 => ['required', 'numeric', 'min:0'],
            'stock'                 => ['required', 'integer', 'min:0'],
            'is_active'             => ['nullable', 'boolean'],

            'colors'                => ['nullable', 'array'],
            'colors.*.pivot_id'     => ['nullable', 'string'],
            'colors.*.name'         => ['nullable', 'string', 'max:100'],
            'colors.*.hex_code'     => ['nullable', 'string', 'max:7'],
            'colors.*.stock'        => ['nullable', 'integer', 'min:0'],
            'colors.*._delete'      => ['nullable', 'boolean'],

            'delete_photos'         => ['nullable', 'array'],
            'delete_photos.*'       => ['string'],

            // Nilainya bisa berupa id foto lama, atau "new:<index>" untuk
            // menandai salah satu foto baru yang baru diupload sebagai utama.
            'primary_photo'         => ['nullable', 'string'],

            'photos'                => ['nullable', 'array'],
            'photos.*'              => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],

            // Dimensi produk
            'general_dimensions'    => ['nullable', 'string', 'max:255'],
            'seat_height'           => ['nullable', 'string', 'max:100'],
            'seat_depth'            => ['nullable', 'string', 'max:100'],
            'arm_height'            => ['nullable', 'string', 'max:100'],
            'total_weight_lbs'      => ['nullable', 'numeric', 'min:0'],
            'box_dimensions'        => ['nullable', 'string', 'max:255'],

            // Shipping & return
            'shipping_info'         => ['nullable', 'string'],
            'return_policy'         => ['nullable', 'string'],
        ]);
    }

    /**
     * Ambil index foto baru yang ditandai sebagai foto utama dari input
     * "primary_photo" (format "new:<index>"). Null kalau tidak ada / yang
     * dipilih adalah foto lama.
     */
    protected function resolveNewPrimaryIndex(Request $request): ?int
    {
        $value = $request->input('primary_photo');

        if (!$value || !Str::startsWith($value, 'new:')) {
            return null;
        }

        return (int) Str::after($value, 'new:');
    }

    /**
     * Tambah / perbarui / hapus warna produk berdasarkan input form.
     *
     * Warna adalah master data (tabel `colors`) yang bisa dipakai banyak
     * produk. Relasi ke produk disimpan di tabel pivot `product_color`
     * (menyimpan stok khusus untuk kombinasi produk+warna tersebut).
     *
     * `pivot_id` mengacu ke id baris pivot (bukan id warna), dipakai untuk
     * mengenali baris mana yang sedang diedit / dihapus di form.
     */
    protected function syncColors(Product $product, array $colors): void
    {
        foreach ($colors as $colorData) {
            $pivotId = $colorData['pivot_id'] ?? null;

            // Hapus baris yang ditandai untuk dihapus
            if (!empty($colorData['_delete'])) {
                if ($pivotId) {
                    DB::table('product_color')->where('id', $pivotId)->delete();
                }
                continue;
            }

            // Lewati baris kosong (misalnya baris template yang tidak diisi)
            if (empty($colorData['name'])) {
                continue;
            }

            // Cari warna yang sudah ada berdasarkan nama, atau buat warna baru
            $color = Color::firstOrCreate(
                ['name' => $colorData['name']],
                ['hex_code' => $colorData['hex_code'] ?? null]
            );

            if (!empty($colorData['hex_code']) && $color->hex_code !== $colorData['hex_code']) {
                $color->update(['hex_code' => $colorData['hex_code']]);
            }

            $stock = $colorData['stock'] ?? 0;

            if ($pivotId) {
                // Perbarui baris pivot yang sudah ada (bisa jadi warnanya diganti)
                DB::table('product_color')->where('id', $pivotId)->update([
                    'color_id'   => $color->id,
                    'stock'      => $stock,
                    'updated_at' => now(),
                ]);

                continue;
            }

            // Cek dulu supaya tidak melanggar unique constraint (product_id + color_id)
            $existing = DB::table('product_color')
                ->where('product_id', $product->id)
                ->where('color_id', $color->id)
                ->first();

            if ($existing) {
                DB::table('product_color')->where('id', $existing->id)->update([
                    'stock'      => $stock,
                    'updated_at' => now(),
                ]);
            } else {
                $product->colors()->attach($color->id, [
                    'id'    => (string) Str::uuid(),
                    'stock' => $stock,
                ]);
            }
        }
    }

    /**
     * Simpan / perbarui data dimensi produk (relasi one-to-one).
     */
    protected function syncDimension(Product $product, array $validated): void
    {
        $data = [
            'general_dimensions' => $validated['general_dimensions'] ?? null,
            'seat_height'        => $validated['seat_height'] ?? null,
            'seat_depth'         => $validated['seat_depth'] ?? null,
            'arm_height'         => $validated['arm_height'] ?? null,
            'total_weight_lbs'   => $validated['total_weight_lbs'] ?? null,
            'box_dimensions'     => $validated['box_dimensions'] ?? null,
        ];

        // Kalau semua field kosong, tidak perlu buat baris kosong
        if (collect($data)->filter(fn ($value) => $value !== null && $value !== '')->isEmpty()) {
            $product->dimension()->delete();
            return;
        }

        $product->dimension()->updateOrCreate(['product_id' => $product->id], $data);
    }

    /**
     * Simpan / perbarui data shipping & return produk (relasi one-to-one).
     */
    protected function syncShippingAndReturn(Product $product, array $validated): void
    {
        $data = [
            'shipping_info' => $validated['shipping_info'] ?? null,
            'return_policy' => $validated['return_policy'] ?? null,
        ];

        if (collect($data)->filter(fn ($value) => $value !== null && $value !== '')->isEmpty()) {
            $product->shippingAndReturn()->delete();
            return;
        }

        $product->shippingAndReturn()->updateOrCreate(['product_id' => $product->id], $data);
    }

    /**
     * Hapus foto yang dipilih (checkbox "Hapus" pada foto lama di form edit).
     */
    protected function deletePhotos(Product $product, array $photoIds): void
    {
        if (empty($photoIds)) {
            return;
        }

        $photos = $product->photos()->whereIn('id', $photoIds)->get();

        foreach ($photos as $photo) {
            $this->deletePhotoFile($photo->file_name);
            $photo->delete();
        }
    }

    /**
     * Set foto primary berdasarkan pilihan radio "primary_photo" (untuk foto lama).
     */
    protected function updatePrimaryPhoto(Product $product, string $primaryPhotoId): void
    {
        $photo = $product->photos()->where('id', $primaryPhotoId)->first();

        if ($photo) {
            $photo->update(['is_primary' => true]); // model otomatis nonaktifkan foto primary lain
        }
    }

    /**
     * Upload dan simpan foto baru (bisa lebih dari satu sekaligus).
     *
     * $primaryIndex adalah index (dimulai dari 0, sesuai urutan file yang
     * dipilih user) dari foto baru yang ditandai sebagai foto utama lewat
     * preview di form. Null berarti tidak ada foto baru yang dipilih sebagai
     * utama secara eksplisit — fallback: foto baru pertama jadi utama hanya
     * jika produk belum punya foto utama sama sekali.
     */
    protected function storeNewPhotos(Product $product, Request $request, ?int $primaryIndex = null): void
    {
        if (!$request->hasFile('photos')) {
            return;
        }

        // Kalau user secara eksplisit memilih salah satu foto baru sebagai
        // utama, lepas status utama dari semua foto lain terlebih dahulu.
        if ($primaryIndex !== null) {
            $product->photos()->update(['is_primary' => false]);
        }

        $hasPrimary = $primaryIndex !== null
            ? false
            : $product->photos()->where('is_primary', true)->exists();

        $sortOrder = (int) $product->photos()->max('sort_order');

        foreach ($request->file('photos') as $index => $file) {
            if (!$file || !$file->isValid()) {
                continue;
            }

            $filename = Str::slug($product->name) . '-' . Str::random(6) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path(self::UPLOAD_PATH), $filename);

            $sortOrder++;

            $isPrimary = $primaryIndex !== null
                ? ($index === $primaryIndex)
                : !$hasPrimary;

            ProductPhoto::create([
                'product_id' => $product->id,
                'file_name'  => self::UPLOAD_PATH . '/' . $filename,
                'is_primary' => $isPrimary,
                'sort_order' => $sortOrder,
            ]);

            if ($isPrimary) {
                $hasPrimary = true; // pastikan tidak ada foto lain yang ikut jadi primary di loop ini
            }
        }
    }

    /**
     * Hapus file fisik foto dari public/assets/img/products,
     * hanya jika file tersebut memang berada di folder upload admin.
     */
    protected function deletePhotoFile(string $fileName): void
    {
        if (Str::startsWith($fileName, self::UPLOAD_PATH . '/')) {
            $fullPath = public_path($fileName);

            if (file_exists($fullPath)) {
                @unlink($fullPath);
            }
        }
    }
}