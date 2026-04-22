@extends('layouts.app')

@section('content')
<section class="hero">
    <h1 class="page-title">Модерация комментариев</h1>
    <p class="page-subtitle">Здесь отображаются комментарии, ожидающие подтверждения модератором.</p>
</section>

<section class="form-card">
    @if($comments->count() > 0)
        @foreach($comments as $comment)
            <div class="comment-card" style="margin-bottom: 18px;">
                <p class="comment-author">
                    Автор: {{ $comment->user->name ?? 'Неизвестный пользователь' }}
                </p>

                <p style="margin: 0 0 8px; color: #6b7280;">
                    К статье:
                    <a href="{{ route('posts.show', $comment->post) }}">
                        {{ $comment->post->title ?? 'Без названия' }}
                    </a>
                </p>

                <p class="comment-text">{{ $comment->content }}</p>

                <div class="card-actions">
                    <form method="POST" action="{{ route('comments.approve', $comment) }}" style="display:inline;">
                        @csrf
                        <button type="submit" class="btn btn-success">Одобрить</button>
                    </form>

                    <form method="POST" action="{{ route('comments.destroy', $comment) }}" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Отклонить</button>
                    </form>
                </div>
            </div>
        @endforeach

        @if($comments->hasPages())
            <div class="pagination-wrapper" style="margin-top: 28px; display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
                @if($comments->onFirstPage())
                    <span class="btn btn-dark" style="opacity: .45; pointer-events: none;">Назад</span>
                @else
                    <a href="{{ $comments->previousPageUrl() }}" class="btn btn-dark">Назад</a>
                @endif

                @foreach($comments->getUrlRange(1, $comments->lastPage()) as $page => $url)
                    @if($page == $comments->currentPage())
                        <span class="btn btn-primary">{{ $page }}</span>
                    @else
                        <a href="{{ $url }}" class="btn btn-dark">{{ $page }}</a>
                    @endif
                @endforeach

                @if($comments->hasMorePages())
                    <a href="{{ $comments->nextPageUrl() }}" class="btn btn-dark">Вперед</a>
                @else
                    <span class="btn btn-dark" style="opacity: .45; pointer-events: none;">Вперед</span>
                @endif
            </div>
        @endif
    @else
        <p style="margin: 0;">Комментариев, ожидающих модерации, сейчас нет.</p>
    @endif
</section>
@endsectionphp artisan optimize:clear