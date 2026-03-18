# DBtecno

Bu repository iki parçadan oluşur:

1. **Legacy uygulama** (kök dizindeki eski PHP dosyaları)
2. **Laravel yeniden yazım paketi**: `dbtecno-laravel-rewrite/`

Kullanıcı isteğine göre proje Laravel ile baştan ele alındı ve yeni repo oluşturmayı kolaylaştıran otomatik script eklendi.

## Yeni Laravel repo oluştur (önerilen)
Repo kökünde şu komutu çalıştır:

```bash
bash scripts/create_laravel_rewrite_repo.sh dbtecno-ecommerce-laravel
```

Bu komut:
- Yeni bir Laravel projesi oluşturur.
- `dbtecno-laravel-rewrite/` içindeki kodları yeni projeye aktarır.
- `php artisan key:generate` çalıştırır.
- Yeni klasörde `git init` yapar ve ilk commit’i atar.

Ardından:

```bash
cd dbtecno-ecommerce-laravel
# .env dosyasında veritabanı ayarlarını düzenleyin
php artisan migrate
php artisan serve
```

## Laravel yeniden yazım kapsamı
- Gelişmiş ürün kataloğu (arama, filtreleme, sıralama)
- Stok kontrollü sepet
- Favori yönetimi
- Checkout + order/order_items transaction akışı
- Responsive Blade arayüzler
- FormRequest + Service katmanı ile daha temiz mimari

Detay: [`dbtecno-laravel-rewrite/README.md`](dbtecno-laravel-rewrite/README.md)

## Önemli not
Bu çalışma ortamında Packagist erişimi kısıtlı olduğu için burada doğrudan `composer create-project` tamamlanamayabilir. Script, bunu kendi bilgisayarında tek komutta yapman için hazırlanmıştır.
