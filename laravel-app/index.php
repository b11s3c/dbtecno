<?php

declare(strict_types=1);

$hasArtisan = file_exists(__DIR__ . '/artisan');
?>
<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DBtecno Laravel Preview</title>
    <style>
        body{font-family:Arial,sans-serif;background:#f3f4f6;margin:0;color:#0f172a}
        .wrap{max-width:900px;margin:40px auto;padding:0 16px}
        .card{background:#fff;border:1px solid #e2e8f0;border-radius:12px;padding:20px}
        code{background:#e2e8f0;padding:2px 6px;border-radius:6px}
    </style>
</head>
<body>
<div class="wrap">
    <div class="card">
        <h1>DBtecno Laravel Önizleme</h1>
        <?php if ($hasArtisan): ?>
            <p>Bu dizin çalışır Laravel projesi içeriyor. <code>php artisan serve</code> komutu ile başlatabilirsiniz.</p>
        <?php else: ?>
            <p>Bu dizin şu anda <strong>blueprint</strong> içeriyor; tam Laravel runtime (artisan/vendor) yok.</p>
            <p>Bu nedenle <code>php artisan serve</code> ve gerçek route önizlemesi çalışmaz.</p>
            <p>Yine de bu sayfa sayesinde önizleme adresi <code>Not Found</code> yerine açıklayıcı bir ekran gösterir.</p>
        <?php endif; ?>
        <hr>
        <p>Legacy sürümü önizlemek için repo kökünde:</p>
        <p><code>php -S 127.0.0.1:8000 -t .</code></p>
    </div>
</div>
</body>
</html>
