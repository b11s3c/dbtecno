# Migration Notes

Legacy DBtecno PHP yapısından Laravel sürümüne geçerken aşağıdaki eşlemeler yapıldı:

## Ana veri yapıları
- Eski çoklu ürün tabloları yerine tek `products` tablosu kullanılır.
- Kullanıcıya bağlı sepet verileri `cart_items` tablosunda tutulur.
- Favoriler `favorites` tablosuna taşındı.
- Ürün yorum/değerlendirmeleri `evaluations` tablosunda tutulur.
- Sipariş akışı `orders` ve `order_items` tablolarına ayrıldı.

## Önemli farklar
- Sepette ürün fiyatı, sipariş anında değişmemesi için `unit_price` snapshot olarak saklanır.
- Sipariş toplamları (`subtotal`, `shipping_fee`, `grand_total`) checkout sırasında hesaplanır.
- Ürün aktiflik durumu `is_active` ile yönetilir.
- Ürün açıklama/spec verileri daha düzenli alanlara ayrıldı.

## Lokal kurulum akışı
```bash
cp .env.example .env
composer install
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
php artisan serve
```

## Seeder içeriği
`DatabaseSeeder` şu örnek verileri ekler:
- 1 demo kullanıcı
- 12 örnek ürün
- örnek favoriler/sepet verileri
- örnek değerlendirmeler
# Legacy -> Laravel Geçiş Notları

## Legacy tespitleri
- İş kuralları `libs/*.php` içinde dağınık durumda.
- Her ürün kategorisi ayrı tablo (`computers`, `phones`, `smart_watchs`, ...).
- SQL seviyesinde güçlü FK yapısı eksik.
- Session ve auth işlemleri dağınık procedural kodla ilerliyor.

## Laravel ile önerilen hedef
1. `products` tablosunda ortak alanları birleştirip teknik özellikleri `json` olarak tutmak.
2. İşlevleri controller + service sınıflarına ayırmak.
3. Authentication için Laravel starter kit (Breeze/Jetstream) kullanmak.
4. Sipariş sürecini transaction ile yönetmek.
5. Validation ve authorization politikalarını merkezi hale getirmek.

## Örnek tablo eşleme
- `computers/phones/...` -> `products`
- `sepet` -> `cart_items`
- `favorites` -> `favorites`
- `evaluations` -> `evaluations`
