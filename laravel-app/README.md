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
