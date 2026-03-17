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
