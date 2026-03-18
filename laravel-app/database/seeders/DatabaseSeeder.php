<?php

namespace Database\Seeders;

use App\Models\CartItem;
use App\Models\Evaluation;
use App\Models\Favorite;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::query()->updateOrCreate(
            ['email' => 'demo@dbtecno.test'],
            [
                'name' => 'Demo Müşteri',
                'password' => Hash::make('password'),
            ]
        );

        $products = collect([
            ['code' => 1001, 'brand' => 'Canon', 'model' => 'PIXMA G3470', 'series' => 'PIXMA', 'category' => 'Yazıcı', 'type' => 'Mürekkep Tanklı', 'color' => 'Siyah', 'short_description' => 'Ev ve küçük ofis için ekonomik çok fonksiyonlu yazıcı.', 'price' => 8999.00, 'discount_price' => 8199.00, 'stock' => 12],
            ['code' => 1002, 'brand' => 'HP', 'model' => 'LaserJet M211dw', 'series' => 'LaserJet', 'category' => 'Yazıcı', 'type' => 'Lazer', 'color' => 'Beyaz', 'short_description' => 'Kablosuz mono lazer yazıcı, hızlı çıktı alımı.', 'price' => 6499.00, 'discount_price' => null, 'stock' => 9],
            ['code' => 1003, 'brand' => 'Brother', 'model' => 'DCP-T720DW', 'series' => 'DCP', 'category' => 'Yazıcı', 'type' => 'Çok Fonksiyonlu', 'color' => 'Siyah', 'short_description' => 'ADF destekli tanklı çok fonksiyonlu çözüm.', 'price' => 10999.00, 'discount_price' => 9999.00, 'stock' => 7],
            ['code' => 1004, 'brand' => 'Epson', 'model' => 'EcoTank L3260', 'series' => 'EcoTank', 'category' => 'Yazıcı', 'type' => 'Tanklı', 'color' => 'Siyah', 'short_description' => 'Fotoğraf ve ofis işleri için dengeli baskı kalitesi.', 'price' => 7799.00, 'discount_price' => 7399.00, 'stock' => 10],
            ['code' => 2001, 'brand' => 'Logitech', 'model' => 'MX Master 3S', 'series' => 'MX', 'category' => 'Aksesuar', 'type' => 'Mouse', 'color' => 'Grafit', 'short_description' => 'Profesyonel üretkenlik için sessiz premium mouse.', 'price' => 4299.00, 'discount_price' => 3999.00, 'stock' => 15],
            ['code' => 2002, 'brand' => 'Logitech', 'model' => 'MX Keys S', 'series' => 'MX', 'category' => 'Aksesuar', 'type' => 'Klavye', 'color' => 'Siyah', 'short_description' => 'Arka aydınlatmalı tam boy kablosuz klavye.', 'price' => 4699.00, 'discount_price' => null, 'stock' => 11],
            ['code' => 2003, 'brand' => 'Apple', 'model' => 'Magic Keyboard', 'series' => 'Magic', 'category' => 'Aksesuar', 'type' => 'Klavye', 'color' => 'Beyaz', 'short_description' => 'Minimalist ve hafif kablosuz klavye.', 'price' => 5599.00, 'discount_price' => 5299.00, 'stock' => 8],
            ['code' => 3001, 'brand' => 'Samsung', 'model' => 'Odyssey G5', 'series' => 'Odyssey', 'category' => 'Monitör', 'type' => 'Gaming', 'color' => 'Siyah', 'short_description' => 'QHD çözünürlüklü yüksek tazeleme hızlı monitör.', 'price' => 11999.00, 'discount_price' => 10999.00, 'stock' => 6],
            ['code' => 3002, 'brand' => 'LG', 'model' => '27UP650-W', 'series' => 'UltraFine', 'category' => 'Monitör', 'type' => '4K IPS', 'color' => 'Beyaz', 'short_description' => 'İçerik üretimi için renk doğruluğu yüksek 4K ekran.', 'price' => 13499.00, 'discount_price' => null, 'stock' => 5],
            ['code' => 3003, 'brand' => 'Dell', 'model' => 'P2422H', 'series' => 'Professional', 'category' => 'Monitör', 'type' => 'IPS', 'color' => 'Siyah', 'short_description' => 'Kurumsal kullanım için ergonomik FHD monitör.', 'price' => 6899.00, 'discount_price' => 6499.00, 'stock' => 14],
            ['code' => 4001, 'brand' => 'Kingston', 'model' => 'NV2 1TB', 'series' => 'NV2', 'category' => 'Depolama', 'type' => 'SSD', 'color' => 'Mavi', 'short_description' => 'NVMe performansı ile hızlı sistem diski.', 'price' => 2499.00, 'discount_price' => 2199.00, 'stock' => 18],
            ['code' => 4002, 'brand' => 'WD', 'model' => 'My Passport 2TB', 'series' => 'My Passport', 'category' => 'Depolama', 'type' => 'Harici Disk', 'color' => 'Mavi', 'short_description' => 'Taşınabilir ve güvenli yedekleme çözümü.', 'price' => 3599.00, 'discount_price' => null, 'stock' => 13],
        ])->map(fn (array $payload) => Product::query()->updateOrCreate(['code' => $payload['code']], $payload));

        foreach ($products->take(4) as $index => $product) {
            Evaluation::query()->updateOrCreate(
                ['product_id' => $product->id, 'customer_id' => $user->id],
                [
                    'score' => 5 - ($index % 2),
                    'comment' => 'Demo değerlendirme: hızlı kargo, iyi paketleme ve başarılı ürün deneyimi.',
                    'is_approved' => true,
                ]
            );
        }

        Favorite::query()->updateOrCreate(
            ['customer_id' => $user->id, 'product_id' => $products[0]->id],
            []
        );
        Favorite::query()->updateOrCreate(
            ['customer_id' => $user->id, 'product_id' => $products[7]->id],
            []
        );

        CartItem::query()->updateOrCreate(
            ['customer_id' => $user->id, 'product_id' => $products[4]->id],
            ['quantity' => 1, 'unit_price' => $products[4]->current_price]
        );
        CartItem::query()->updateOrCreate(
            ['customer_id' => $user->id, 'product_id' => $products[10]->id],
            ['quantity' => 2, 'unit_price' => $products[10]->current_price]
        );
    }
}
