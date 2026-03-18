<?php
?><!doctype html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>DBtecno Laravel Preview</title>
    <style>
        body{margin:0;font-family:Inter,Arial,sans-serif;background:#eff6ff;color:#0f172a}
        .wrap{max-width:1100px;margin:0 auto;padding:40px 20px}
        .hero{display:grid;grid-template-columns:2fr 1fr;gap:18px}
        .card{background:#fff;border:1px solid #dbeafe;border-radius:20px;padding:24px;box-shadow:0 12px 30px rgba(15,23,42,.08)}
        .dark{background:linear-gradient(135deg,#0f172a,#1d4ed8);color:#fff;border:none}
        .grid{display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-top:18px}
        .pill{display:inline-block;padding:6px 10px;border-radius:999px;background:#dbeafe;color:#1d4ed8;font-weight:700;font-size:12px}
        h1{font-size:38px;margin:16px 0 10px} h3{margin:0 0 8px}
        p{line-height:1.6} .muted{color:#64748b}
        @media (max-width: 800px){.hero,.grid{grid-template-columns:1fr}}
    </style>
</head>
<body>
<div class="wrap">
    <div class="hero">
        <section class="card dark">
            <span class="pill">Preview</span>
            <h1>DBtecno Laravel yeniden yazımı</h1>
            <p>Bu ekran, Composer bağımlılıkları kurulmadan önce de yeni vitrinin görsel yönünü hızlıca doğrulamak için bırakıldı.</p>
            <p>Gerçek uygulamayı çalıştırmak için <code>composer install</code>, <code>php artisan migrate --seed</code> ve <code>php artisan serve</code> komutlarını izleyin.</p>
        </section>
        <aside class="card">
            <h3>Öne çıkanlar</h3>
            <p class="muted">• Filtrelenebilir katalog</p>
            <p class="muted">• Stok kontrollü sepet</p>
            <p class="muted">• Favoriler ve sipariş geçmişi</p>
            <p class="muted">• Demo kullanıcı ile otomatik oturum</p>
        </aside>
    </div>

    <div class="grid">
        <article class="card"><h3>Ürün Vitrini</h3><p class="muted">Kategori, fiyat ve popülerlik sıralaması.</p></article>
        <article class="card"><h3>Checkout</h3><p class="muted">Adres + ödeme yöntemi + sipariş özeti akışı.</p></article>
        <article class="card"><h3>Sipariş Takibi</h3><p class="muted">Oluşturulan sipariş ve sipariş kalemlerinin listesi.</p></article>
    </div>
</div>
</body>
</html>
