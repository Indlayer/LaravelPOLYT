@extends('layouts.app')

@section('content')
    <section class="hero">
        <h1 class="page-title">{{ $post->title }}</h1>
        <p class="page-subtitle">
            @if($post->category)
                Категория: {{ $post->category->name }}
            @else
                Без категории
            @endif
        </p>
    </section>

    <article class="post-detail">
        @if($post->image)
            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="post-detail-image">
        @else
            <img src="https://placehold.co/1200x700?text=News+Image" alt="{{ $post->title }}" class="post-detail-image">
        @endif

        <p class="post-detail-text">{{ $post->excerpt }}</p>
        <hr style="margin: 22px 0; border: none; border-top: 1px solid #e5e7eb;">
        <div class="post-detail-text">{{ $post->content }}</div>

        <h2 class="section-title">Комментарии</h2>

        @foreach($post->comments->where('is_approved', true) as $comment)
            <div class="comment-card">
                <p class="comment-author">{{ $comment->user->name ?? 'Пользователь' }}</p>
                <p class="comment-text">{{ $comment->content }}</p>
            </div>
        @endforeach

        @auth
            <div class="form-card" style="margin-top: 22px;">
                <h3 style="margin-top:0;">Оставить комментарий</h3>

                <form method="POST" action="{{ route('comments.store', $post) }}">
                    @csrf
                    <div class="form-group">
                        <textarea class="form-textarea" name="content" placeholder="Введите комментарий"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Отправить</button>
                </form>
            </div>
        @endauth

        @auth
            @if(auth()->user()->role && auth()->user()->role->name === 'admin')
                <h2 class="section-title">Комментарии на модерации</h2>

                @foreach($post->comments->where('is_approved', false) as $comment)
                    <div class="comment-card">
                        <p class="comment-author">{{ $comment->user->name ?? 'Пользователь' }}</p>
                        <p class="comment-text">{{ $comment->content }}</p>

                        <div class="card-actions">
                            <form method="POST" action="{{ route('comments.approve', $comment) }}">
                                @csrf
                                <button type="submit" class="btn btn-success">Одобрить</button>
                            </form>

                            <form method="POST" action="{{ route('comments.destroy', $comment) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Удалить</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            @endif
        @endauth
    </article>
@endsection