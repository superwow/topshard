<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title ?? 'TopShard') ?></title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            color-scheme: dark;
            --bg: #0b0c10;
            --surface: #161821;
            --muted: #9aa5b1;
            --text: #e5e7eb;
            --primary: #7dd3fc;
            --accent: #a78bfa;
            --danger: #f87171;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            background: var(--bg);
            color: var(--text);
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
        }
        a { color: var(--primary); text-decoration: none; }
        a:hover { color: var(--accent); }
        header {
            background: #0f1118;
            border-bottom: 1px solid #1f2937;
            position: sticky;
            top: 0;
            z-index: 10;
        }
        .container { max-width: 1100px; margin: 0 auto; padding: 0 1.25rem; }
        .nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            height: 64px;
        }
        .nav-links { display: flex; gap: 1rem; }
        main { padding: 2rem 0 3rem; }
        footer {
            border-top: 1px solid #1f2937;
            padding: 1.5rem 0;
            background: #0f1118;
            color: var(--muted);
            font-size: 0.95rem;
        }
        .card {
            background: var(--surface);
            border: 1px solid #1f2937;
            border-radius: 12px;
            padding: 1.25rem;
            margin-bottom: 1rem;
            box-shadow: 0 10px 30px rgba(0,0,0,0.25);
        }
        .pill {
            display: inline-flex;
            align-items: center;
            gap: 0.35rem;
            padding: 0.3rem 0.65rem;
            background: #1f2937;
            border-radius: 999px;
            font-size: 0.85rem;
            color: var(--muted);
        }
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.35rem;
            padding: 0.65rem 1rem;
            border-radius: 10px;
            border: 1px solid transparent;
            background: linear-gradient(135deg, #22d3ee, #8b5cf6);
            color: #0b0c10;
            font-weight: 700;
            cursor: pointer;
            transition: transform 0.1s ease, box-shadow 0.1s ease;
        }
        .btn:hover { transform: translateY(-1px); box-shadow: 0 10px 20px rgba(0,0,0,0.35); }
        .grid { display: grid; gap: 1rem; }
        .grid-2 { grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); }
        .muted { color: var(--muted); }
        h1, h2, h3, h4 { margin: 0 0 0.5rem; }
        p { margin: 0.35rem 0; }
        .input {
            width: 100%;
            padding: 0.7rem 0.85rem;
            background: #0f1118;
            border: 1px solid #1f2937;
            border-radius: 10px;
            color: var(--text);
        }
        .filters { display: grid; grid-template-columns: repeat(auto-fit, minmax(180px, 1fr)); gap: 0.75rem; margin-bottom: 1rem; }
        .table { width: 100%; border-collapse: collapse; }
        .table th, .table td { padding: 0.75rem 0.5rem; border-bottom: 1px solid #1f2937; text-align: left; }
        .badge { padding: 0.25rem 0.5rem; border-radius: 6px; font-size: 0.85rem; color: #0b0c10; }
        .badge.active { background: #4ade80; }
        .badge.pending { background: #fbbf24; }
        .badge.disabled { background: #f87171; }
    </style>
</head>
<body>
<header>
    <div class="container nav">
        <div class="logo">
            <a href="/" style="font-weight:800;font-size:1.1rem;letter-spacing:0.01em;">TopShard</a>
        </div>
        <nav class="nav-links">
            <a href="/servers">Каталог</a>
            <a href="/promo">Промо</a>
            <a href="/rules">Правила</a>
            <a href="/about">О проекте</a>
            <a href="/admin">Админка</a>
        </nav>
        <div>
            <a class="btn" href="/add">Добавить сервер</a>
        </div>
    </div>
</header>

<main class="container">
    <?= $this->renderSection('content') ?>
</main>

<footer>
    <div class="container">
        <div>TopShard — каталог игровых серверов. Тёмная тема forever.</div>
        <div class="muted">Beta / MVP — многое в разработке, метрики и антифрод будут позже.</div>
    </div>
</footer>
</body>
</html>
