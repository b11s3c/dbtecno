# DBtecno Laravel Refactor (Blueprint)

Bu klasör, legacy PHP e-ticaret projesini Laravel mimarisine taşıyan güçlendirilmiş bir blueprint içerir.

## Güçlendirmeler
- **Gelişmiş katalog backend'i**: arama + kategori + fiyat aralığı + sıralama + popülerlik filtreleri.
- **Güvenli sepet yönetimi**: stok doğrulaması, birim fiyatın sepete yazılması, ara toplam/kargo/genel toplam hesapları.
- **Checkout + sipariş akışı**: `orders` / `order_items` tabloları, transaction içinde sipariş oluşturma, stok düşümü, sepet temizleme.
- **Modern frontend bileşenleri**: responsive layout, filtre paneli, ürün kartları, favori/sepet/checkout sayfaları.
- **Eloquent ilişkileri**: `Product`, `CartItem`, `Favorite`, `Evaluation`, `Order`, `OrderItem`.

## Yerel ortamda çalıştırma
Bu klasör tek başına Laravel runtime içermez (`vendor`, `artisan` ve diğer kurulum dosyaları eksik olabilir).
Bu nedenle bilgisayarda çalıştırma için iki seçenek vardır:

### 1) Otomatik (önerilen)
Repo kökünden:
```bash
bash scripts/setup_laravel_blueprint.sh dbtecno-laravel
```
Sonra yeni klasörde:
```bash
cd dbtecno-laravel
php artisan migrate
php artisan serve
```

### 2) Manuel
1. Laravel projesi oluşturun:
   ```bash
   composer create-project laravel/laravel dbtecno-laravel
   ```
2. Bu klasördeki `app/`, `routes/`, `database/migrations/`, `resources/views/` dosyalarını yeni projeye taşıyın.
3. `.env` üzerinde veritabanı bilgilerini ayarlayın.
4. Migration çalıştırın:
   ```bash
   php artisan migrate
   ```
5. Geliştirme sunucusu:
   ```bash
   php artisan serve
   ```

## Bu ortamda hızlı önizleme
Tam Laravel kurulumu ağ kısıtı nedeniyle yapılamadığında, blueprint ekranını görmek için:
```bash
php -S 127.0.0.1:8000 -t laravel-app
```
Bu komut `laravel-app/index.php` açıklama ekranını açar ve `Not Found` sorununu engeller.
