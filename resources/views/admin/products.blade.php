@extends('layouts.admin')

@section('title', 'Kelola Produk')

@section('content')

    {{-- Notifikasi status --}}
    @if (session('status'))
        <div class="rounded-xl border border-olive-600/30 bg-olive-600/10 px-4 py-3 text-sm text-olive-700">
            {{ session('status') }}
        </div>
    @endif

    {{-- Header + tombol tambah --}}
    <div class="flex items-center justify-between gap-4">
        <div>
            <h2 class="font-display text-xl text-charcoal-900">Daftar Produk</h2>
            <p class="text-sm text-charcoal-900/50">Kelola produk sofa, warna, dan foto.</p>
        </div>
        <button type="button" onclick="openModal('modal-add-product')"
            class="inline-flex items-center gap-2 rounded-xl bg-charcoal-900 text-stone-50 px-4 py-2.5 text-sm font-medium hover:bg-charcoal-800 transition shrink-0">
            <i class="fa-solid fa-plus"></i>
            <span class="hidden sm:inline">Tambah Produk</span>
        </button>
    </div>

    {{-- Tabel produk --}}
    <div class="bg-white rounded-2xl border border-line overflow-hidden">

        {{-- Tampilan tabel untuk desktop --}}
        <div class="hidden md:block overflow-x-auto">
            <table class="w-full text-sm">
                <thead>
                    <tr class="text-left text-charcoal-900/50 text-xs uppercase tracking-wide">
                        <th class="px-6 py-3 font-medium">Produk</th>
                        <th class="px-6 py-3 font-medium">Warna</th>
                        <th class="px-6 py-3 font-medium">Harga</th>
                        <th class="px-6 py-3 font-medium">Stok</th>
                        <th class="px-6 py-3 font-medium">Status</th>
                        <th class="px-6 py-3 font-medium text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-line">
                    @forelse ($products as $product)
                        @php $primaryPhoto = $product->primaryPhoto ?? $product->photos->first(); @endphp
                        <tr class="hover:bg-stone-50">
                            <td class="px-6 py-4">
                                <div class="flex items-center gap-3">
                                    <img src="{{ $primaryPhoto ? asset($primaryPhoto->file_name) : 'https://placehold.co/80x80?text=No+Photo' }}"
                                        alt="{{ $product->name }}"
                                        class="w-12 h-12 rounded-lg object-cover border border-line shrink-0">
                                    <div class="min-w-0">
                                        <p class="font-medium text-charcoal-900 truncate">{{ $product->name }}</p>
                                        <p class="text-xs text-charcoal-900/50">{{ $product->sku ?? '-' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center -space-x-1.5">
                                    @foreach ($product->colors as $color)
                                        <span class="w-5 h-5 rounded-full border-2 border-white shadow-sm"
                                            style="background-color: {{ $color->hex_code ?? '#D9D0C1' }}"
                                            title="{{ $color->name }}"></span>
                                    @endforeach
                                    @if ($product->colors->isEmpty())
                                        <span class="text-xs text-charcoal-900/40">-</span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 text-charcoal-900/80">Rp{{ number_format($product->price, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 text-charcoal-900/80">{{ $product->stock }}</td>
                            <td class="px-6 py-4">
                                @if ($product->is_active)
                                    <span class="status-pill bg-olive-600/20 text-olive-700">Aktif</span>
                                @else
                                    <span class="status-pill bg-line text-charcoal-900/60">Nonaktif</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center justify-end gap-2">
                                    <button type="button" onclick="openModal('modal-edit-{{ $product->id }}')"
                                        class="w-9 h-9 rounded-lg border border-line flex items-center justify-center text-charcoal-900/70 hover:text-charcoal-900 hover:bg-stone-100"
                                        title="Edit produk">
                                        <i class="fa-solid fa-pen text-xs"></i>
                                    </button>
                                    <button type="button"
                                        onclick="confirmDelete('{{ route('admin.produk.destroy', $product) }}', {{ Js::from($product->name) }})"
                                        class="w-9 h-9 rounded-lg border border-line flex items-center justify-center text-clay-400 hover:text-clay-400 hover:bg-clay-300/10"
                                        title="Hapus produk">
                                        <i class="fa-solid fa-trash text-xs"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-sm text-charcoal-900/50">
                                Belum ada produk. Klik "Tambah Produk" untuk menambahkan.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Tampilan kartu untuk mobile --}}
        <div class="md:hidden divide-y divide-line">
            @forelse ($products as $product)
                @php $primaryPhoto = $product->primaryPhoto ?? $product->photos->first(); @endphp
                <div class="px-5 py-4">
                    <div class="flex items-center gap-3 mb-3">
                        <img src="{{ $primaryPhoto ? asset($primaryPhoto->file_name) : 'https://placehold.co/80x80?text=No+Photo' }}"
                            alt="{{ $product->name }}"
                            class="w-14 h-14 rounded-lg object-cover border border-line shrink-0">
                        <div class="min-w-0 flex-1">
                            <p class="font-medium text-sm text-charcoal-900 truncate">{{ $product->name }}</p>
                            <p class="text-xs text-charcoal-900/50">{{ $product->sku ?? '-' }}</p>
                            <p class="text-sm font-medium text-charcoal-900 mt-1">
                                Rp{{ number_format($product->price, 0, ',', '.') }}</p>
                        </div>
                        @if ($product->is_active)
                            <span class="status-pill bg-olive-600/20 text-olive-700 shrink-0">Aktif</span>
                        @else
                            <span class="status-pill bg-line text-charcoal-900/60 shrink-0">Nonaktif</span>
                        @endif
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center -space-x-1.5">
                            @foreach ($product->colors as $color)
                                <span class="w-5 h-5 rounded-full border-2 border-white shadow-sm"
                                    style="background-color: {{ $color->hex_code ?? '#D9D0C1' }}"
                                    title="{{ $color->name }}"></span>
                            @endforeach
                        </div>

                        <div class="flex items-center gap-2">
                            <button type="button" onclick="openModal('modal-edit-{{ $product->id }}')"
                                class="w-9 h-9 rounded-lg border border-line flex items-center justify-center text-charcoal-900/70">
                                <i class="fa-solid fa-pen text-xs"></i>
                            </button>
                            <button type="button"
                                onclick="confirmDelete('{{ route('admin.produk.destroy', $product) }}', {{ Js::from($product->name) }})"
                                class="w-9 h-9 rounded-lg border border-line flex items-center justify-center text-clay-400">
                                <i class="fa-solid fa-trash text-xs"></i>
                            </button>
                        </div>
                    </div>
                </div>
            @empty
                <div class="px-5 py-10 text-center text-sm text-charcoal-900/50">
                    Belum ada produk. Klik "Tambah Produk" untuk menambahkan.
                </div>
            @endforelse
        </div>
    </div>

    {{-- Pagination --}}
    @if ($products->hasPages())
        <div>
            {{ $products->links() }}
        </div>
    @endif

    {{-- ================= MODAL TAMBAH PRODUK ================= --}}
    <div id="modal-add-product" class="fixed inset-0 z-[100] hidden items-center justify-center p-4">
        <div class="absolute inset-0 bg-charcoal-900/60" onclick="closeModal('modal-add-product')"></div>
        <div class="relative bg-white rounded-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto p-6">
            <h3 class="font-display text-lg text-charcoal-900 mb-4">Tambah Produk</h3>

            <form id="modal-add-product-form" method="POST" action="{{ route('admin.produk.store') }}"
                enctype="multipart/form-data" class="space-y-4">
                @csrf

                <div>
                    <label class="block text-sm font-medium text-charcoal-900 mb-1">Nama Produk</label>
                    <input type="text" name="name" required
                        class="w-full rounded-xl border border-line px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-charcoal-900/20">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-charcoal-900 mb-1">SKU</label>
                        <input type="text" name="sku"
                            class="w-full rounded-xl border border-line px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-charcoal-900/20">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-charcoal-900 mb-1">Stok</label>
                        <input type="number" name="stock" min="0" value="0" required
                            class="w-full rounded-xl border border-line px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-charcoal-900/20">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-charcoal-900 mb-1">Harga</label>
                    <input type="number" name="price" min="0" step="1000" required
                        class="w-full rounded-xl border border-line px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-charcoal-900/20">
                </div>

                <div>
                    <label class="block text-sm font-medium text-charcoal-900 mb-1">Material</label>
                    <input type="text" name="material"
                        class="w-full rounded-xl border border-line px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-charcoal-900/20">
                </div>

                <div>
                    <label class="block text-sm font-medium text-charcoal-900 mb-1">Deskripsi</label>
                    <textarea name="description" rows="3"
                        class="w-full rounded-xl border border-line px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-charcoal-900/20"></textarea>
                </div>

                {{-- Foto produk (multiple) --}}
                <div>
                    <label class="block text-sm font-medium text-charcoal-900 mb-1">Foto Produk</label>
                    <input type="file" name="photos[]" multiple accept="image/*"
                        onchange="previewNewPhotos(this, 'modal-add-product-photo-preview', 'add')"
                        class="w-full rounded-xl border border-line px-4 py-2.5 text-sm file:mr-3 file:rounded-lg file:border-0 file:bg-stone-100 file:px-3 file:py-1.5 file:text-sm">
                    <p class="text-xs text-charcoal-900/50 mt-1">
                        Bisa pilih beberapa foto sekaligus. Klik ikon bintang pada foto untuk menjadikannya foto
                        utama.
                    </p>
                    <div id="modal-add-product-photo-preview" class="grid grid-cols-5 gap-2 mt-3" data-has-existing="0">
                    </div>
                </div>

                {{-- Warna --}}
                <div>
                    <div class="flex items-center justify-between mb-2">
                        <label class="block text-sm font-medium text-charcoal-900">Warna</label>
                        <button type="button" onclick="addColorRow('modal-add-product')"
                            class="text-xs font-medium text-charcoal-900/70 hover:text-charcoal-900">
                            <i class="fa-solid fa-plus mr-1"></i>Tambah Warna
                        </button>
                    </div>
                    <p class="text-xs text-charcoal-900/50 mb-2">
                        Ketik nama warna yang sudah ada untuk memakainya kembali, atau nama baru untuk membuat
                        warna baru.
                    </p>
                    <div id="modal-add-product-colors" class="space-y-2"></div>

                    <template id="modal-add-product-color-template">
                        <div class="flex items-center gap-2" data-color-row>
                            <input type="color" name="colors[__INDEX__][hex_code]" value="#D9D0C1" data-color-hex
                                class="w-10 h-10 rounded-lg border border-line shrink-0">

                            <select name="colors[__INDEX__][name]" data-color-select onchange="handleColorSelect(this)"
                                class="flex-1 rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-charcoal-900/20">
                                <option value="">-- Pilih warna --</option>
                                @foreach ($availableColors as $existingColor)
                                    <option value="{{ $existingColor->name }}"
                                        data-hex="{{ $existingColor->hex_code }}">{{ $existingColor->name }}</option>
                                @endforeach
                                <option value="__new__">+ Warna baru…</option>
                            </select>

                            <input type="text" name="colors[__INDEX__][name]" placeholder="Nama warna baru"
                                data-color-new-name disabled
                                class="hidden flex-1 rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-charcoal-900/20">

                            <button type="button" onclick="removeColorRow(this)"
                                class="w-9 h-9 rounded-lg border border-line flex items-center justify-center text-clay-400 shrink-0">
                                <i class="fa-solid fa-xmark text-xs"></i>
                            </button>
                        </div>
                    </template>
                </div>

                {{-- Dimensi Produk --}}
                <div class="border-t border-line pt-4">
                    <label class="block text-sm font-medium text-charcoal-900 mb-2">Dimensi Produk</label>
                    <div class="grid grid-cols-2 gap-3">
                        <div>
                            <label class="block text-xs text-charcoal-900/60 mb-1">General Dimensions</label>
                            <input type="text" name="general_dimensions" placeholder='84"W x 36"D x 32"H'
                                class="w-full rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-charcoal-900/20">
                        </div>
                        <div>
                            <label class="block text-xs text-charcoal-900/60 mb-1">Box Dimensions</label>
                            <input type="text" name="box_dimensions" placeholder='88"L x 38"W x 30"H'
                                class="w-full rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-charcoal-900/20">
                        </div>
                        <div>
                            <label class="block text-xs text-charcoal-900/60 mb-1">Seat Height</label>
                            <input type="text" name="seat_height" placeholder='18"'
                                class="w-full rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-charcoal-900/20">
                        </div>
                        <div>
                            <label class="block text-xs text-charcoal-900/60 mb-1">Seat Depth</label>
                            <input type="text" name="seat_depth" placeholder='22"'
                                class="w-full rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-charcoal-900/20">
                        </div>
                        <div>
                            <label class="block text-xs text-charcoal-900/60 mb-1">Arm Height</label>
                            <input type="text" name="arm_height" placeholder='24"'
                                class="w-full rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-charcoal-900/20">
                        </div>
                        <div>
                            <label class="block text-xs text-charcoal-900/60 mb-1">Total Weight (lbs)</label>
                            <input type="number" name="total_weight_lbs" min="0" step="0.01"
                                placeholder="120.5"
                                class="w-full rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-charcoal-900/20">
                        </div>
                    </div>
                </div>

                {{-- Shipping & Return --}}
                <div class="border-t border-line pt-4">
                    <label class="block text-sm font-medium text-charcoal-900 mb-2">Shipping & Return</label>
                    <div class="space-y-3">
                        <div>
                            <label class="block text-xs text-charcoal-900/60 mb-1">Informasi Shipping</label>
                            <textarea name="shipping_info" rows="2"
                                class="w-full rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-charcoal-900/20"></textarea>
                        </div>
                        <div>
                            <label class="block text-xs text-charcoal-900/60 mb-1">Kebijakan Return</label>
                            <textarea name="return_policy" rows="2"
                                class="w-full rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-charcoal-900/20"></textarea>
                        </div>
                    </div>
                </div>

                <label class="flex items-center gap-2">
                    <input type="checkbox" name="is_active" value="1" checked
                        class="rounded border-line text-charcoal-900 focus:ring-charcoal-900/20">
                    <span class="text-sm text-charcoal-900">Aktifkan produk</span>
                </label>

                <div class="flex gap-3 pt-2">
                    <button type="button" onclick="closeModal('modal-add-product')"
                        class="flex-1 rounded-xl border border-line py-2.5 text-sm font-medium text-charcoal-900 hover:bg-stone-50">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 rounded-xl bg-charcoal-900 text-stone-50 py-2.5 text-sm font-medium hover:bg-charcoal-800">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- ================= MODAL EDIT PRODUK — satu per produk ================= --}}
    @foreach ($products as $product)
        @php $formId = 'modal-edit-' . $product->id; @endphp
        <div id="{{ $formId }}" class="fixed inset-0 z-[100] hidden items-center justify-center p-4">
            <div class="absolute inset-0 bg-charcoal-900/60" onclick="closeModal('{{ $formId }}')"></div>
            <div class="relative bg-white rounded-2xl w-full max-w-2xl max-h-[90vh] overflow-y-auto p-6">
                <h3 class="font-display text-lg text-charcoal-900 mb-4">Edit Produk</h3>

                <form id="{{ $formId }}-form" method="POST"
                    action="{{ route('admin.produk.update', $product) }}" enctype="multipart/form-data"
                    class="space-y-4">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-medium text-charcoal-900 mb-1">Nama Produk</label>
                        <input type="text" name="name" value="{{ $product->name }}" required
                            class="w-full rounded-xl border border-line px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-charcoal-900/20">
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-charcoal-900 mb-1">SKU</label>
                            <input type="text" name="sku" value="{{ $product->sku }}"
                                class="w-full rounded-xl border border-line px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-charcoal-900/20">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-charcoal-900 mb-1">Stok</label>
                            <input type="number" name="stock" min="0" value="{{ $product->stock }}" required
                                class="w-full rounded-xl border border-line px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-charcoal-900/20">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-charcoal-900 mb-1">Harga</label>
                        <input type="number" name="price" min="0" step="1000"
                            value="{{ $product->price }}" required
                            class="w-full rounded-xl border border-line px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-charcoal-900/20">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-charcoal-900 mb-1">Material</label>
                        <input type="text" name="material" value="{{ $product->material }}"
                            class="w-full rounded-xl border border-line px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-charcoal-900/20">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-charcoal-900 mb-1">Deskripsi</label>
                        <textarea name="description" rows="3"
                            class="w-full rounded-xl border border-line px-4 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-charcoal-900/20">{{ $product->description }}</textarea>
                    </div>

                    {{-- Foto produk: foto lama + tambah foto baru (multiple) --}}
                    <div>
                        <label class="block text-sm font-medium text-charcoal-900 mb-1">Foto Produk</label>

                        @if ($product->photos->isNotEmpty())
                            <div class="grid grid-cols-5 gap-2 mb-3">
                                @foreach ($product->photos as $photo)
                                    <div
                                        class="relative rounded-lg overflow-hidden border border-line has-[:checked]:border-charcoal-900 has-[:checked]:ring-2 has-[:checked]:ring-charcoal-900 has-[:checked]:ring-offset-1 transition">
                                        <input type="radio" id="primary-{{ $photo->id }}" name="primary_photo"
                                            value="{{ $photo->id }}" @checked($photo->is_primary)
                                            class="peer sr-only">

                                        <label for="primary-{{ $photo->id }}" class="block cursor-pointer"
                                            title="Jadikan foto utama">
                                            <img src="{{ asset($photo->file_name) }}" class="w-full h-20 object-cover">
                                        </label>

                                        <span
                                            class="pointer-events-none absolute top-1 right-1 w-5 h-5 rounded-full border-2 border-white bg-white/70 text-transparent peer-checked:bg-olive-600 peer-checked:text-white flex items-center justify-center text-[10px]">
                                            <i class="fa-solid fa-star"></i>
                                        </span>
                                        <span
                                            class="pointer-events-none absolute top-1 left-1 hidden peer-checked:block text-[9px] font-medium bg-charcoal-900 text-white px-1.5 py-0.5 rounded">
                                            Utama
                                        </span>

                                        <label
                                            class="absolute bottom-1 inset-x-1 flex items-center justify-center gap-1 text-[10px] bg-clay-400/90 text-white rounded px-1 py-0.5 cursor-pointer">
                                            <input type="checkbox" name="delete_photos[]" value="{{ $photo->id }}"
                                                class="w-3 h-3">
                                            Hapus
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        <input type="file" name="photos[]" multiple accept="image/*"
                            onchange="previewNewPhotos(this, '{{ $formId }}-photo-preview', '{{ $formId }}')"
                            class="w-full rounded-xl border border-line px-4 py-2.5 text-sm file:mr-3 file:rounded-lg file:border-0 file:bg-stone-100 file:px-3 file:py-1.5 file:text-sm">
                        <p class="text-xs text-charcoal-900/50 mt-1">
                            Tambahkan foto baru. Klik ikon bintang untuk menjadikan foto utama, atau centang
                            "Hapus" pada foto lama untuk menghapusnya.
                        </p>
                        <div id="{{ $formId }}-photo-preview" class="grid grid-cols-5 gap-2 mt-3"
                            data-has-existing="{{ $product->photos->isNotEmpty() ? '1' : '0' }}"></div>
                    </div>

                    {{-- Warna --}}
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label class="block text-sm font-medium text-charcoal-900">Warna</label>
                            <button type="button" onclick="addColorRow('{{ $formId }}')"
                                class="text-xs font-medium text-charcoal-900/70 hover:text-charcoal-900">
                                <i class="fa-solid fa-plus mr-1"></i>Tambah Warna
                            </button>
                        </div>
                        <p class="text-xs text-charcoal-900/50 mb-2">
                            Ketik nama warna yang sudah ada untuk memakainya kembali, atau nama baru untuk membuat
                            warna baru.
                        </p>

                        <div id="{{ $formId }}-colors" class="space-y-2">
                            @foreach ($product->colors as $i => $color)
                                <div class="flex items-center gap-2" data-color-row>
                                    {{-- pivot_id = id baris pivot product_color (bukan id warna) --}}
                                    <input type="hidden" name="colors[{{ $i }}][pivot_id]"
                                        value="{{ $color->pivot->id }}" data-color-id>
                                    <input type="hidden" name="colors[{{ $i }}][_delete]" value="0"
                                        data-color-delete>
                                    <input type="color" name="colors[{{ $i }}][hex_code]"
                                        value="{{ $color->hex_code ?? '#D9D0C1' }}" data-color-hex
                                        class="w-10 h-10 rounded-lg border border-line shrink-0">

                                    <select name="colors[{{ $i }}][name]" data-color-select
                                        onchange="handleColorSelect(this)"
                                        class="flex-1 rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-charcoal-900/20">
                                        <option value="">-- Pilih warna --</option>
                                        @foreach ($availableColors as $existingColor)
                                            <option value="{{ $existingColor->name }}"
                                                data-hex="{{ $existingColor->hex_code }}" @selected($existingColor->name === $color->name)>
                                                {{ $existingColor->name }}
                                            </option>
                                        @endforeach
                                        <option value="__new__">+ Warna baru…</option>
                                    </select>

                                    <input type="text" name="colors[{{ $i }}][name]"
                                        placeholder="Nama warna baru" data-color-new-name disabled
                                        class="hidden flex-1 rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-charcoal-900/20">
                                        
                                    <button type="button" onclick="removeColorRow(this)"
                                        class="w-9 h-9 rounded-lg border border-line flex items-center justify-center text-clay-400 shrink-0">
                                        <i class="fa-solid fa-xmark text-xs"></i>
                                    </button>
                                </div>
                            @endforeach
                        </div>

                        <template id="{{ $formId }}-color-template">
                            <div class="flex items-center gap-2" data-color-row>
                                <input type="color" name="colors[__INDEX__][hex_code]" value="#D9D0C1" data-color-hex
                                    class="w-10 h-10 rounded-lg border border-line shrink-0">

                                <select name="colors[__INDEX__][name]" data-color-select
                                    onchange="handleColorSelect(this)"
                                    class="flex-1 rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-charcoal-900/20">
                                    <option value="">-- Pilih warna --</option>
                                    @foreach ($availableColors as $existingColor)
                                        <option value="{{ $existingColor->name }}"
                                            data-hex="{{ $existingColor->hex_code }}">{{ $existingColor->name }}</option>
                                    @endforeach
                                    <option value="__new__">+ Warna baru…</option>
                                </select>

                                <input type="text" name="colors[__INDEX__][name]" placeholder="Nama warna baru"
                                    data-color-new-name disabled
                                    class="hidden flex-1 rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-charcoal-900/20">

        
                                <button type="button" onclick="removeColorRow(this)"
                                    class="w-9 h-9 rounded-lg border border-line flex items-center justify-center text-clay-400 shrink-0">
                                    <i class="fa-solid fa-xmark text-xs"></i>
                                </button>
                            </div>
                        </template>
                    </div>

                    {{-- Dimensi Produk --}}
                    <div class="border-t border-line pt-4">
                        <label class="block text-sm font-medium text-charcoal-900 mb-2">Dimensi Produk</label>
                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs text-charcoal-900/60 mb-1">General Dimensions</label>
                                <input type="text" name="general_dimensions"
                                    value="{{ $product->dimension->general_dimensions ?? '' }}"
                                    placeholder='84"W x 36"D x 32"H'
                                    class="w-full rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-charcoal-900/20">
                            </div>
                            <div>
                                <label class="block text-xs text-charcoal-900/60 mb-1">Box Dimensions</label>
                                <input type="text" name="box_dimensions"
                                    value="{{ $product->dimension->box_dimensions ?? '' }}"
                                    placeholder='88"L x 38"W x 30"H'
                                    class="w-full rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-charcoal-900/20">
                            </div>
                            <div>
                                <label class="block text-xs text-charcoal-900/60 mb-1">Seat Height</label>
                                <input type="text" name="seat_height"
                                    value="{{ $product->dimension->seat_height ?? '' }}" placeholder='18"'
                                    class="w-full rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-charcoal-900/20">
                            </div>
                            <div>
                                <label class="block text-xs text-charcoal-900/60 mb-1">Seat Depth</label>
                                <input type="text" name="seat_depth"
                                    value="{{ $product->dimension->seat_depth ?? '' }}" placeholder='22"'
                                    class="w-full rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-charcoal-900/20">
                            </div>
                            <div>
                                <label class="block text-xs text-charcoal-900/60 mb-1">Arm Height</label>
                                <input type="text" name="arm_height"
                                    value="{{ $product->dimension->arm_height ?? '' }}" placeholder='24"'
                                    class="w-full rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-charcoal-900/20">
                            </div>
                            <div>
                                <label class="block text-xs text-charcoal-900/60 mb-1">Total Weight (lbs)</label>
                                <input type="number" name="total_weight_lbs" min="0" step="0.01"
                                    value="{{ $product->dimension->total_weight_lbs ?? '' }}" placeholder="120.5"
                                    class="w-full rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-charcoal-900/20">
                            </div>
                        </div>
                    </div>

                    {{-- Shipping & Return --}}
                    <div class="border-t border-line pt-4">
                        <label class="block text-sm font-medium text-charcoal-900 mb-2">Shipping & Return</label>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-xs text-charcoal-900/60 mb-1">Informasi Shipping</label>
                                <textarea name="shipping_info" rows="2"
                                    class="w-full rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-charcoal-900/20">{{ $product->shippingAndReturn->shipping_info ?? '' }}</textarea>
                            </div>
                            <div>
                                <label class="block text-xs text-charcoal-900/60 mb-1">Kebijakan Return</label>
                                <textarea name="return_policy" rows="2"
                                    class="w-full rounded-xl border border-line px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-charcoal-900/20">{{ $product->shippingAndReturn->return_policy ?? '' }}</textarea>
                            </div>
                        </div>
                    </div>

                    <label class="flex items-center gap-2">
                        <input type="checkbox" name="is_active" value="1" @checked($product->is_active)
                            class="rounded border-line text-charcoal-900 focus:ring-charcoal-900/20">
                        <span class="text-sm text-charcoal-900">Aktifkan produk</span>
                    </label>

                    <div class="flex gap-3 pt-2">
                        <button type="button" onclick="closeModal('{{ $formId }}')"
                            class="flex-1 rounded-xl border border-line py-2.5 text-sm font-medium text-charcoal-900 hover:bg-stone-50">
                            Batal
                        </button>
                        <button type="submit"
                            class="flex-1 rounded-xl bg-charcoal-900 text-stone-50 py-2.5 text-sm font-medium hover:bg-charcoal-800">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endforeach

    {{-- ================= MODAL KONFIRMASI HAPUS ================= --}}
    <div id="modal-delete" class="fixed inset-0 z-[100] hidden items-center justify-center p-4">
        <div class="absolute inset-0 bg-charcoal-900/60" onclick="closeModal('modal-delete')"></div>
        <div class="relative bg-white rounded-2xl w-full max-w-sm p-6">
            <div class="w-11 h-11 rounded-full bg-clay-300/20 text-clay-400 flex items-center justify-center mb-4">
                <i class="fa-solid fa-triangle-exclamation"></i>
            </div>
            <h3 class="font-display text-lg text-charcoal-900 mb-1">Hapus produk ini?</h3>
            <p class="text-sm text-charcoal-900/60 mb-6">
                Produk "<span id="delete-product-name" class="font-medium text-charcoal-900"></span>" beserta semua
                foto, dimensi, dan data shipping/return-nya akan dihapus permanen (warna master tidak ikut
                terhapus). Tindakan ini tidak bisa dibatalkan.
            </p>
            <form id="form-delete" method="POST" action="">
                @csrf
                @method('DELETE')
                <div class="flex gap-3">
                    <button type="button" onclick="closeModal('modal-delete')"
                        class="flex-1 rounded-xl border border-line py-2.5 text-sm font-medium text-charcoal-900 hover:bg-stone-50">
                        Batal
                    </button>
                    <button type="submit"
                        class="flex-1 rounded-xl bg-charcoal-900 text-stone-50 py-2.5 text-sm font-medium hover:bg-charcoal-800">
                        Ya, Hapus
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        // Saat user memilih warna dari dropdown:
        // - kalau pilih warna yang sudah ada, isi otomatis kotak hex sesuai warna itu.
        // - kalau pilih "+ Warna baru…", sembunyikan select dan tampilkan input teks
        //   untuk mengetik nama warna baru.
        function handleColorSelect(select) {
            const row = select.closest('[data-color-row]');
            if (!row) return;

            const hexInput = row.querySelector('[data-color-hex]');
            const newNameInput = row.querySelector('[data-color-new-name]');

            if (select.value === '__new__') {
                select.disabled = true;
                select.classList.add('hidden');
                newNameInput.disabled = false;
                newNameInput.classList.remove('hidden');
                newNameInput.value = '';
                newNameInput.focus();
                return;
            }

            const option = select.selectedOptions[0];
            const hex = option?.dataset?.hex;
            if (hexInput && hex) {
                hexInput.value = hex;
            }
        }

        function openModal(id) {
            const modal = document.getElementById(id);
            if (!modal) return;
            modal.classList.remove('hidden');
            modal.classList.add('flex');
        }

        function closeModal(id) {
            const modal = document.getElementById(id);
            if (!modal) return;
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }

        function confirmDelete(url, name) {
            document.getElementById('form-delete').action = url;
            document.getElementById('delete-product-name').textContent = name;
            openModal('modal-delete');
        }

        // Tambah baris warna baru pada form tertentu
        function addColorRow(formId) {
            const container = document.getElementById(`${formId}-colors`);
            const template = document.getElementById(`${formId}-color-template`);
            if (!container || !template) return;

            const index = container.children.length;
            const clone = template.content.cloneNode(true);
            clone.querySelectorAll('[name]').forEach((el) => {
                el.name = el.name.replace('__INDEX__', index);
            });
            container.appendChild(clone);
        }

        // Hapus baris warna: kalau sudah tersimpan (punya pivot_id), tandai _delete lalu sembunyikan.
        // Kalau baris baru (belum punya pivot_id), langsung dihapus dari DOM.
        function removeColorRow(button) {
            const row = button.closest('[data-color-row]');
            const deleteInput = row.querySelector('[data-color-delete]');
            const idInput = row.querySelector('[data-color-id]');

            if (idInput && idInput.value) {
                deleteInput.value = '1';
                row.classList.add('hidden');
            } else {
                row.remove();
            }
        }

        // Tampilkan preview foto yang baru dipilih user (belum diupload),
        // lengkap dengan tombol bintang untuk menandai foto utama.
        // formId dipakai untuk membuat id radio yang unik antar form.
        function previewNewPhotos(input, containerId, formId) {
            const container = document.getElementById(containerId);
            if (!container) return;

            container.innerHTML = '';
            if (!input.files || input.files.length === 0) return;

            const hasExisting = container.dataset.hasExisting === '1';

            Array.from(input.files).forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = (event) => {
                    const radioId = `${formId}-new-primary-${index}`;
                    const wrapper = document.createElement('div');
                    wrapper.className =
                        'relative rounded-lg overflow-hidden border border-line has-[:checked]:border-charcoal-900 has-[:checked]:ring-2 has-[:checked]:ring-charcoal-900 has-[:checked]:ring-offset-1 transition';

                    const shouldAutoCheck = !hasExisting && index === 0;

                    wrapper.innerHTML = `
                        <input type="radio" id="${radioId}" name="primary_photo" value="new:${index}"
                            class="peer sr-only" ${shouldAutoCheck ? 'checked' : ''}>
                        <label for="${radioId}" class="block cursor-pointer" title="Jadikan foto utama">
                            <img src="${event.target.result}" class="w-full h-20 object-cover">
                        </label>
                        <span class="pointer-events-none absolute top-1 right-1 w-5 h-5 rounded-full border-2 border-white bg-white/70 text-transparent peer-checked:bg-olive-600 peer-checked:text-white flex items-center justify-center text-[10px]">
                            <i class="fa-solid fa-star"></i>
                        </span>
                        <span class="pointer-events-none absolute top-1 left-1 hidden peer-checked:block text-[9px] font-medium bg-charcoal-900 text-white px-1.5 py-0.5 rounded">
                            Utama
                        </span>
                    `;

                    container.appendChild(wrapper);
                };
                reader.readAsDataURL(file);
            });
        }
    </script>
@endpush
