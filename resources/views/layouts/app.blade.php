<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NovaNews — новостной портал</title>
    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background: #f4f7fb;
            color: #1f2937;
        }

        a {
            color: #1d4ed8;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .container {
            width: min(1180px, calc(100% - 32px));
            margin: 0 auto;
        }

        .topbar {
            background: #111827;
            color: #ffffff;
            border-bottom: 1px solid #1f2937;
        }

        .topbar-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            padding: 16px 0;
            flex-wrap: wrap;
        }

        .brand {
            font-size: 24px;
            font-weight: 700;
            color: #ffffff;
        }

        .nav {
            display: flex;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
        }

        .nav a {
            color: #e5e7eb;
            font-weight: 600;
        }

        .search-form {
            display: flex;
            gap: 10px;
            align-items: center;
            flex-wrap: wrap;
        }

        .search-form input {
            width: 240px;
            max-width: 100%;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            padding: 10px 12px;
        }

        .btn {
            display: inline-block;
            padding: 10px 14px;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            font-weight: 700;
            font-size: 14px;
        }

        .btn-primary {
            background: #2563eb;
            color: #ffffff;
        }

        .btn-dark {
            background: #111827;
            color: #ffffff;
        }

        .btn-danger {
            background: #dc2626;
            color: #ffffff;
        }

        .btn-success {
            background: #16a34a;
            color: #ffffff;
        }

        .hero {
            padding: 28px 0 10px;
        }

        .page-title {
            margin: 0 0 8px;
            font-size: 34px;
            line-height: 1.15;
        }

        .page-subtitle {
            margin: 0;
            color: #6b7280;
        }

        .flash {
            margin: 16px 0;
            padding: 14px 16px;
            border-radius: 12px;
            background: #dcfce7;
            color: #166534;
            border: 1px solid #86efac;
        }

        .grid {
            display: grid;
            grid-template-columns: 260px 1fr;
            gap: 24px;
            padding: 24px 0 40px;
        }

        .sidebar,
        .card,
        .form-card,
        .comment-card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 18px;
            box-shadow: 0 8px 30px rgba(15, 23, 42, 0.06);
        }

        .sidebar {
            padding: 18px;
            height: fit-content;
        }

        .sidebar-title {
            margin: 0 0 14px;
            font-size: 18px;
        }

        .category-list {
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .category-list li {
            margin-bottom: 10px;
        }

        .content-column {
            min-width: 0;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 20px;
        }

        .card {
            overflow: hidden;
        }

        .card-image {
            display: block;
            width: 100%;
            height: 220px;
            object-fit: cover;
            background: #e5e7eb;
        }

        .card-body {
            padding: 18px;
        }

        .badge {
            display: inline-block;
            margin-bottom: 12px;
            padding: 6px 10px;
            border-radius: 999px;
            background: #dbeafe;
            color: #1d4ed8;
            font-size: 12px;
            font-weight: 700;
        }

        .card-title {
            margin: 0 0 12px;
            font-size: 24px;
            line-height: 1.2;
        }

        .card-text {
            margin: 0 0 16px;
            color: #4b5563;
            line-height: 1.6;
        }

        .card-actions {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            align-items: center;
        }

        .pagination-wrapper {
            margin-top: 24px;
        }

        .form-card {
            padding: 24px;
        }

        .form-group {
            margin-bottom: 16px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            font-weight: 700;
        }

        .form-input,
        .form-textarea,
        .form-select {
            width: 100%;
            padding: 12px 14px;
            border: 1px solid #d1d5db;
            border-radius: 12px;
            font-size: 15px;
        }

        .form-textarea {
            min-height: 140px;
            resize: vertical;
        }

        .error-box {
            margin-bottom: 16px;
            padding: 14px 16px;
            border-radius: 12px;
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fca5a5;
        }

        .post-detail {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: 20px;
            padding: 28px;
            box-shadow: 0 8px 30px rgba(15, 23, 42, 0.06);
        }

        .post-detail-image {
            width: 100%;
            max-height: 420px;
            object-fit: cover;
            border-radius: 18px;
            margin-bottom: 20px;
            background: #e5e7eb;
        }

        .post-detail-title {
            margin: 0 0 10px;
            font-size: 38px;
            line-height: 1.1;
        }

        .post-detail-text {
            color: #374151;
            line-height: 1.8;
            white-space: pre-line;
        }

        .section-title {
            margin: 26px 0 16px;
            font-size: 24px;
        }

        .comment-card {
            padding: 16px;
            margin-bottom: 14px;
        }

        .comment-author {
            margin: 0 0 8px;
            font-weight: 700;
        }

        .comment-text {
            margin: 0 0 12px;
            color: #374151;
            line-height: 1.6;
        }

        .footer {
            border-top: 1px solid #e5e7eb;
            padding: 24px 0 32px;
            color: #6b7280;
        }

        @media (max-width: 980px) {
            .grid {
                grid-template-columns: 1fr;
            }

            .cards {
                grid-template-columns: 1fr;
            }

            .search-form input {
                width: 100%;
            }
        }
    </style>
</head>
<body>
<header class="topbar">
    <div class="container topbar-inner">
    <a href="{{ route('posts.index') }}" class="brand">NovaNews</a>

        <nav class="nav">
            <a href="{{ route('posts.index') }}">Новости</a>
            <a href="{{ route('about') }}">О нас</a>
            <a href="{{ route('contacts') }}">Контакты</a>

            @guest
                <a href="{{ route('register') }}">Регистрация</a>
                <a href="{{ route('login') }}">Вход</a>
            @endguest

            @auth
    <span style="color:#cbd5e1;">Пользователь: {{ auth()->user()->name }}</span>
    @can('create', App\Models\Post::class)
        <a href="{{ route('posts.create') }}">Создать новость</a>
    @endcan
    @if(auth()->user()->role && auth()->user()->role->name === 'admin')
        <a href="{{ route('comments.moderation') }}">Модерация комментариев</a>
    @endif
    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
        @csrf
        <button type="submit" class="btn btn-primary">Выйти</button>
    </form>
@endauth
        </nav>

        <form action="{{ route('posts.search') }}" method="GET" class="search-form">
            <input type="text" name="q" placeholder="Поиск по новостям" value="{{ request('q') }}">
            <button type="submit" class="btn btn-primary">Найти</button>
        </form>
    </div>
</header>

<main class="container">
    @if (session('success'))
        <div class="flash">
            {{ session('success') }}
        </div>
    @endif

    @yield('content')
</main>

<footer class="footer">
    <div class="container">
        <p style="margin:0;">© 2026 NovaNews | Разработчик: Тимофей Белов 243-323</p>
    </div>
</footer>
</body>
</html>