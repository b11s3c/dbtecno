<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'DBtecno Laravel Rewrite' }}</title>
    <style>
        :root { --bg:#f3f4f6; --card:#fff; --primary:#1d4ed8; --ink:#0f172a; --muted:#64748b; --ok:#0f766e; --line:#e2e8f0; }
        * { box-sizing: border-box; }
        body { font-family: Inter, Arial, sans-serif; margin:0; background:var(--bg); color:var(--ink); }
        a { color:var(--primary); text-decoration:none; }
        .container { max-width: 1120px; margin: 0 auto; padding: 0 16px; }
        .topbar { background:#0b1220; color:#fff; }
        .topbar .container { display:flex; align-items:center; justify-content:space-between; padding:14px 16px; }
        .menu { display:flex; gap:14px; align-items:center; }
        .menu a { color:#dbeafe; }
        .hero { padding:20px 0; }
        .grid { display:grid; grid-template-columns: repeat(auto-fill, minmax(220px,1fr)); gap:14px; }
        .card { background:var(--card); border:1px solid var(--line); border-radius:14px; padding:14px; box-shadow:0 6px 16px rgba(15,23,42,.06); }
        .muted { color:var(--muted); }
        .row { display:flex; gap:10px; align-items:center; flex-wrap:wrap; }
        .btn { border:0; background:var(--primary); color:#fff; border-radius:10px; padding:9px 12px; cursor:pointer; }
        .btn-outline { background:#fff; color:var(--primary); border:1px solid var(--primary); }
        .badge { font-size:12px; padding:3px 8px; background:#dcfce7; color:#166534; border-radius:999px; }
        input, select, textarea { border:1px solid #cbd5e1; border-radius:10px; padding:8px 10px; width:100%; }
        .form-grid { display:grid; grid-template-columns: 2fr 1fr 1fr 1fr auto; gap:10px; }
        .status { background:#ecfeff; color:var(--ok); padding:10px 12px; border-radius:10px; margin-bottom:12px; border:1px solid #99f6e4; }
        @media (max-width: 768px) {.form-grid { grid-template-columns: 1fr; }}
    </style>
</head>
<body>
<header class="topbar">
    <div class="container">
        <strong>DBtecno · Laravel Rewrite</strong>
        <nav class="menu">
            <a href="{{ route('home') }}">Ürünler</a>
            <a href="{{ route('cart.index') }}">Sepet</a>
            <a href="{{ route('favorites.index') }}">Favoriler</a>
            <a href="{{ route('checkout.index') }}">Ödeme</a>
        </nav>
    </div>
</header>
<main class="container hero">
    @if(session('status'))
        <div class="status">{{ session('status') }}</div>
    @endif
    @yield('content')
</main>
</body>
</html>
