# Legacy -> Laravel Geçiş Notları

## Legacy tespitleri
- İş kuralları `libs/*.php` içinde dağınık durumda.
- Her ürün kategorisi ayrı tablo (`computers`, `phones`, `smart_watchs`, ...).
- SQL seviyesinde güçlü FK yapısı eksik.
- Session ve auth işlemleri dağınık procedural kodla ilerliyor.

## Laravel ile hedeflenen güçlü yapı
1. `products` tablosunda ortak alanları birleştirmek (`discount_price`, `is_active`, `short_description` dahil).
2. İşlevleri controller + model + (ileride) service sınıflarına ayırmak.
3. Authentication için Laravel starter kit (Breeze/Jetstream) kullanmak.
4. Sepet ve sipariş sürecini transaction + stok kontrolüyle yönetmek.
5. Validation ve authorization politikalarını merkezi hale getirmek.

## Örnek tablo eşleme
- `computers/phones/...` -> `products`
- `sepet` -> `cart_items`
- `favorites` -> `favorites`
- `evaluations` -> `evaluations`
- `orders` (yeni)
- `order_items` (yeni)

## Uygulanan backend iyileştirmeleri
- Ürün listelemede arama, kategori, min/max fiyat ve sıralama desteği.
- Sepette stok doğrulama ve birim fiyatın snapshot olarak saklanması.
- Checkout sırasında:
  - sipariş + sipariş kalemleri üretimi,
  - ürün stok düşümü,
  - başarılı işlem sonunda sepet temizliği.
