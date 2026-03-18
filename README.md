# DBtecno

Bu repo artık iki parçalı bir geçiş denemesi değil; içinde **çalıştırılabilir Laravel yeniden yazımı** taşıyan net bir geliştirme deposudur.

## Dizinler
- `laravel-app/`: Çalıştırılabilir Laravel e-ticaret uygulaması
- `dbtecno-laravel-rewrite/`: Önceki taşınabilir paket/blueprint referansı
- kök dizin: eski legacy PHP dosyaları

## En iyi seçenek: Laravel uygulamasını çalıştır
```bash
cd laravel-app
cp .env.example .env
composer install
php artisan key:generate
touch database/database.sqlite
php artisan migrate --seed
php artisan serve
```

Sonra şu adresi aç:

```text
http://127.0.0.1:8000
```

## Uygulamada hazır olanlar
- filtrelenebilir ürün kataloğu
- ürün detay sayfası
- stok kontrollü sepet
- favoriler
- checkout
- sipariş geçmişi
- örnek veri seed işlemi
- demo kullanıcı ile otomatik giriş

## Yeni bir repo olarak kopyalamak istersen
Ağ erişimi olmadan da yeni repo oluşturmak için:

```bash
bash scripts/create_laravel_rewrite_repo.sh ../dbtecno-shop-laravel
```

Bu script `laravel-app/` klasörünü yeni hedefe kopyalar, `.env` oluşturur ve yeni git reposu başlatır.

## Hızlı görsel önizleme
Composer kurmadan önce sadece arayüz fikrini görmek için:

```bash
php -S 127.0.0.1:8080 -t laravel-app/public
```

ve `http://127.0.0.1:8080/preview.php` adresini ziyaret et.

## Not
Bu çalışma ortamında Packagist erişimi 403 döndüğü için `composer install` burada tamamlanamadı. Buna rağmen proje yapısı, dosya organizasyonu, Laravel bootstrapping dosyaları, seed mantığı ve çalıştırma dökümü gerçek lokal kullanım için hazırlandı.
