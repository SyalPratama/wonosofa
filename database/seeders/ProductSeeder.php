<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductPhoto;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        /** @var Product $product */
        $product = Product::create([
            'name'        => 'Kova Pillow Cushion Sofa 122',
            'sku'         => 'SF-KOVA-122',
            'description' => 'Sofa pillow cushion dengan desain lembut dan nyaman, tersedia dalam beberapa pilihan warna netral.',
            'material'    => 'Kain Linen',
            'price'       => 7900000,
            'stock'       => 10,
            'is_active'   => true,
        ]);

        $colors = [
            ['name' => 'White',   'hex_code' => '#F4F1EA', 'photo' => 'assets/img/home/sofa_white.webp'],
            ['name' => 'Camel',   'hex_code' => '#C19A6B', 'photo' => 'assets/img/home/sofa_camel.webp'],
            ['name' => 'Navy',    'hex_code' => '#1F2A44', 'photo' => 'assets/img/home/sofa_navy.webp'],
            ['name' => 'Onyx',    'hex_code' => '#1C1C1C', 'photo' => 'assets/img/home/sofa_onyx.webp'],
            ['name' => 'Oatmeal', 'hex_code' => '#DDD3C0', 'photo' => 'assets/img/home/sofa_oatmeal.webp'],
        ];

        foreach ($colors as $index => $data) {
            $color = $product->colors()->create([
                'name'     => $data['name'],
                'hex_code' => $data['hex_code'],
                'stock'    => 2,
            ]);

            ProductPhoto::create([
                'product_id'       => $product->id,
                'product_color_id' => $color->id,
                'file_name'        => $data['photo'],
                'is_primary'       => $index === 0, // foto warna pertama (White) jadi thumbnail
                'sort_order'       => $index + 1,
            ]);
        }
    }
}