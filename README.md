# DBtecno

DBtecno, teknoloji ürünleri satışı için geliştirilmiş bir e-ticaret projesidir. Eski sürümde saf PHP dosya yapısı kullanılmaktadır.

## Bu repoda yapılan iyileştirme
Bu çalışma kapsamında proje için Laravel tabanlı, modern bir mimariye geçiş amacıyla `laravel-app/` altında bir **refactor blueprint** hazırlandı.

Öne çıkanlar:
- Route + Controller tabanlı MVC yapı
- Eloquent modelleri (`Product`, `CartItem`, `Favorite`, `Evaluation`)
- Migration dosyaları ile şema yönetimi
- Ürün, sepet ve favoriler için örnek Blade sayfaları

Detaylar için: [`laravel-app/README.md`](laravel-app/README.md)
