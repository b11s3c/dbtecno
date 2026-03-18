<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'DBtecno Laravel' }}</title>
    <style>
        :root {
            --bg:#f8fafc;
            --card:#ffffff;
            --dark:#0f172a;
            --muted:#64748b;
            --line:#e2e8f0;
            --primary:#1d4ed8;
            --primary-soft:#dbeafe;
            --success:#0f766e;
            --warning:#b45309;
            --danger:#b91c1c;
        }
        * { box-sizing: border-box; }
        body { margin:0; font-family: Inter, Arial, sans-serif; background:linear-gradient(180deg,#eff6ff 0,#f8fafc 240px); color:var(--dark); }
        a { color:var(--primary); text-decoration:none; }
        .container { max-width: 1180px; margin: 0 auto; padding: 0 20px; }
        .topbar { position:sticky; top:0; z-index:10; backdrop-filter: blur(10px); background:rgba(15,23,42,.92); color:#fff; border-bottom:1px solid rgba(148,163,184,.2); }
        .topbar .container { display:flex; align-items:center; justify-content:space-between; gap:16px; padding:16px 20px; }
        .brand strong { display:block; font-size:18px; }
        .brand span { color:#93c5fd; font-size:12px; }
        .menu { display:flex; align-items:center; gap:16px; flex-wrap:wrap; }
        .menu a { color:#e2e8f0; font-weight:600; }
        .hero { padding:28px 0 44px; }
        .hero-panel { display:grid; grid-template-columns:2fr 1fr; gap:18px; margin-bottom:18px; }
        .card { background:var(--card); border:1px solid var(--line); border-radius:20px; padding:18px; box-shadow:0 10px 30px rgba(15,23,42,.06); }
        .panel-dark { background:linear-gradient(135deg,#0f172a,#1e3a8a); color:#fff; border:none; }
        .grid { display:grid; grid-template-columns: repeat(auto-fill, minmax(250px,1fr)); gap:16px; }
        .stats { display:grid; grid-template-columns:repeat(2,1fr); gap:12px; }
        .stat { border-radius:16px; padding:16px; background:#fff; border:1px solid rgba(255,255,255,.2); color:var(--dark); }
        .muted { color:var(--muted); }
        .row { display:flex; gap:12px; align-items:center; flex-wrap:wrap; }
        .row-between { display:flex; justify-content:space-between; gap:16px; align-items:flex-start; }
        .btn { display:inline-flex; align-items:center; justify-content:center; border:0; border-radius:12px; padding:10px 14px; cursor:pointer; background:var(--primary); color:#fff; font-weight:700; }
        .btn-outline { background:#fff; color:var(--primary); border:1px solid #bfdbfe; }
        .btn-danger { background:#fee2e2; color:var(--danger); }
        .badge { display:inline-flex; align-items:center; gap:6px; border-radius:999px; padding:6px 10px; background:#dcfce7; color:#166534; font-size:12px; font-weight:700; }
        .badge-warn { background:#ffedd5; color:var(--warning); }
        .badge-soft { background:var(--primary-soft); color:var(--primary); }
        input, select, textarea { width:100%; border:1px solid #cbd5e1; border-radius:12px; padding:10px 12px; font:inherit; background:#fff; }
        .form-grid { display:grid; grid-template-columns: 2fr 1fr 1fr 1fr auto; gap:12px; }
        .page-head { display:flex; align-items:end; justify-content:space-between; gap:18px; margin-bottom:14px; }
        .alert { padding:12px 14px; border-radius:14px; margin-bottom:16px; border:1px solid; }
        .alert-success { background:#ecfeff; color:var(--success); border-color:#99f6e4; }
        .alert-error { background:#fef2f2; color:var(--danger); border-color:#fecaca; }
        .price-stack { display:flex; flex-direction:column; gap:4px; }
        .price-old { color:var(--muted); text-decoration:line-through; font-size:13px; }
        .product-card h3 { margin:8px 0 4px; font-size:18px; }
        .product-card p { margin:0; }
        .section-title { margin:28px 0 14px; font-size:24px; }
        .list { display:grid; gap:12px; }
        .summary { position:sticky; top:96px; }
        .spec-list { display:grid; grid-template-columns:repeat(auto-fit,minmax(220px,1fr)); gap:10px; }
        .spec-item { background:#f8fafc; border:1px solid var(--line); border-radius:14px; padding:12px; }
        footer { padding:28px 0 40px; color:var(--muted); }
        @media (max-width: 900px) {
            .hero-panel, .grid-2, .checkout-grid { grid-template-columns:1fr !important; }
            .form-grid { grid-template-columns: 1fr; }
            .summary { position:static; }
        }
    </style>
</head>
<body>
<header class="topbar">
    <div class="container">
        <div class="brand">
            <strong>DBtecno Laravel Rewrite</strong>
            <span>Demo kullanıcı ile hazır e-ticaret vitrini</span>
        </div>
        <nav class="menu">
            <a href="{{ route('home') }}">Ürünler</a>
            <a href="{{ route('cart.index') }}">Sepet</a>
            <a href="{{ route('favorites.index') }}">Favoriler</a>
            <a href="{{ route('orders.index') }}">Siparişler</a>
            <a href="{{ route('checkout.index') }}">Ödeme</a>
        </nav>
    </div>
</header>
<main class="container hero">
    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-error">
            <strong>Formu kontrol edin:</strong>
            <ul style="margin:8px 0 0 18px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @yield('content')
</main>
<footer>
    <div class="container">
        <div class="row-between">
            <div>
                <strong>Demo kullanıcı:</strong> {{ $demoUser?->name ?? 'Hazırlanıyor' }}
                <div class="muted">Otomatik oturum açma ile sepet, favori ve sipariş akışları test edilebilir.</div>
            </div>
            <div class="muted">Kurulumdan sonra: <code>php artisan migrate --seed</code> · <code>php artisan serve</code></div>
        </div>
    </div>
</footer>
    <title>{{ $title ?? 'DBtecno' }}</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background: #f8fafc; }
        header { background: #111827; color: white; padding: 12px 18px; }
        main { max-width: 1080px; margin: 20px auto; padding: 0 16px; }
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 12px; }
        .card { background: white; border-radius: 8px; padding: 12px; box-shadow: 0 2px 6px rgba(0,0,0,.08); }
    </style>
</head>
<body>
<header>
    <strong>DBtecno · Laravel Refactor</strong>
</header>
<main>
    @yield('content')
</main>
</body>
</html>
