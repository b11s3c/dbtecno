<!doctype html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
