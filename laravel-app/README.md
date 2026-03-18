# DBtecno Laravel Uygulaması

Bu klasör artık sadece blueprint değil; **gerçek Laravel proje iskeleti** ve DBtecno e-ticaret yeniden yazımıdır.

## Neler var?
- Ürün kataloğu, arama, kategori/fiyat filtreleri ve sıralama
- Stok kontrollü sepet
- Favori listesi
- Checkout + sipariş + sipariş kalemleri
- Sipariş geçmişi ekranı
- Demo kullanıcı ile otomatik giriş
- Örnek ürün/evaluation verisi için seeder

## Gereksinimler
- PHP 8.2+
- Composer
- SQLite **veya** MySQL

## Hızlı kurulum
```bash
cd laravel-app
cp .env.example .env
composer install
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
php artisan serve
```

Uygulama ardından şu adreste açılır:

```text
http://127.0.0.1:8000
```

## Demo kullanıcı
Login ekranı kurmadan akışı test edebilmen için web isteklerinde otomatik olarak şu kullanıcı oturumu açılır:

- `demo@dbtecno.test`

Bu sayede katalog, sepet, favoriler, checkout ve sipariş ekranları doğrudan çalışır.

## Veritabanı seçimi
Varsayılan `.env.example` SQLite kullanır:

```env
DB_CONNECTION=sqlite
DB_DATABASE=database/database.sqlite
```

MySQL kullanmak istersen `.env` dosyasında bağlantıyı değiştirip ardından:

```bash
php artisan migrate:fresh --seed
```

çalıştır.

## Composer bağımlılıkları kurulmadan önizleme
Sadece görsel yönü hızlıca görmek istersen:

```bash
php -S 127.0.0.1:8080 -t public
```

ve ardından `http://127.0.0.1:8080/preview.php` adresini aç.

## Testler
Bağımlılıklar kurulduktan sonra:

```bash
php artisan test
```
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
