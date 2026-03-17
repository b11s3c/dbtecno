# DBtecno Laravel Refactor (Blueprint)

Bu klasör, mevcut PHP projesini Laravel mimarisine taşımak için hazırlanmış başlangıç iskeletidir.

## Neler iyileştirildi?
- **MVC ayrımı**: Ürün listeleme, detay, favoriler ve sepet işlemleri için controller/model temelli yapı.
- **Tek ürün tablosu yaklaşımı**: `products` tablosu ile `computers/phones/tablets/...` ayrımı normalize edildi.
- **Eloquent ilişkileri**: `CartItem`, `Favorite`, `Order`, `Evaluation` ilişkileri tanımlandı.
- **Route + middleware kurgusu**: Kimlik doğrulama gerektiren alanlar gruplandı.
- **Migration temeli**: Laravel migration dosyalarıyla şema yönetimi başlatıldı.

## Kurulum (internet erişimi olan ortamda)
1. Laravel projesi oluşturun:
   ```bash
   composer create-project laravel/laravel .
   ```
2. Bu klasördeki `app/`, `routes/`, `database/migrations/` dosyalarını kendi Laravel projenize taşıyın.
3. `.env` üzerinde veritabanı bilgilerini ayarlayın.
4. Migration çalıştırın:
   ```bash
   php artisan migrate
   ```
5. Geliştirme sunucusu:
   ```bash
   php artisan serve
   ```

> Not: Bu ortamda Packagist erişimi olmadığı için tam Laravel kurulumu yapılamadı; bu nedenle çalışır bir mavi baskı (blueprint) hazırlanmıştır.
