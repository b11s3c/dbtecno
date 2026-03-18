# DBtecno Laravel Rewrite (Yeni Repo İçeriği)

Bu klasör, DBtecno projesinin **sıfırdan Laravel ile yeniden yazılmış** sürüm kodlarını içerir.

## Neler yeniden yazıldı?
- Ürün kataloğu: arama, kategori, fiyat aralığı, sıralama.
- Sepet: form request validasyonları + servis katmanı + stok kontrolü.
- Favoriler: kullanıcı bazlı ekle/sil/listele.
- Checkout: transaction içinde sipariş oluşturma, sipariş kalemleri üretme, stok düşümü, sepet temizleme.
- Frontend: responsive Blade şablonları (ürün, detay, sepet, favoriler, ödeme).

## Mimari
- `app/Http/Requests`: giriş doğrulama sınıfları
- `app/Services`: iş kuralları (catalog/cart/checkout)
- `app/Http/Controllers`: HTTP katmanı
- `app/Models`: Eloquent modelleri
- `database/migrations`: şema dosyaları
- `routes/web.php`: web route yapısı

## Bilgisayarında yeni repo olarak oluşturma
Bu klasörü yeni bir Laravel reposuna dönüştürmek için repo kökünden:

```bash
bash scripts/create_laravel_rewrite_repo.sh dbtecno-ecommerce-laravel
```

Script şunları yapar:
1. Yeni Laravel projesi oluşturur.
2. Bu klasördeki rewrite dosyalarını içine kopyalar.
3. `php artisan key:generate` çalıştırır.
4. Yeni klasörde `git init` + ilk commit atar.

Sonrasında:
```bash
cd dbtecno-ecommerce-laravel
# .env içindeki DB ayarlarını doldur
php artisan migrate
php artisan serve
```

## Bu ortamda neden tam çalışmıyor?
Bu çalışma ortamında dış ağa (Packagist) erişim kısıtı olduğundan `composer create-project` işlemi burada tamamlanamıyor. Bu yüzden yeni repo üretimi için script ve kaynak dosyalar hazırlandı.
