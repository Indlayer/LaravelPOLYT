<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Новая статья</title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif; background:#f5f5f5; padding:30px;">
    <div style="max-width:700px; margin:0 auto; background:#ffffff; padding:30px; border-radius:12px;">
        <h1 style="margin-top:0;">Добавлена новая статья</h1>

        <p><strong>Заголовок:</strong> {{ $post->title }}</p>

        @if($post->category)
            <p><strong>Категория:</strong> {{ $post->category->name }}</p>
        @endif

        <p><strong>Краткое описание:</strong></p>
        <p>{{ $post->excerpt }}</p>

        <p><strong>Полный текст:</strong></p>
        <p>{{ $post->content }}</p>

        @if($post->published_at)
            <p><strong>Дата публикации:</strong> {{ $post->published_at->format('d.m.Y H:i') }}</p>
        @endif
    </div>
</body>
</html>