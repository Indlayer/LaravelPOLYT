@extends('layouts.app')

@section('content')
    <section class="hero">
        <h1 class="page-title">Новости</h1>

        @isset($category)
            <p class="page-subtitle">Выбрана категория: {{ $category->name }}</p>
        @elseif(!empty($query))
            <p class="page-subtitle">Результаты поиска по запросу: "{{ $query }}"</p>
        @else
            <p class="page-subtitle">Актуальные новости, категории и быстрый поиск по публикациям.</p>
        @endisset
    </section>

    <section class="grid">
        <aside class="sidebar">
            <h3 class="sidebar-title">Категории</h3>

            <ul class="category-list">
                <li>
                    <a href="{{ route('posts.index') }}">Все категории</a>
                </li>
                @foreach($categories as $categoryItem)
                    <li>
                        <a href="{{ route('posts.byCategory', $categoryItem) }}">{{ $categoryItem->name }}</a>
                    </li>
                @endforeach
            </ul>
        </aside>

        <div class="content-column">
            @can('create', App\Models\Post::class)
                <p style="margin-top:0; margin-bottom:18px;">
                    <a href="{{ route('posts.create') }}" class="btn btn-dark">Создать новость</a>
                </p>
            @endcan

            <div class="cards">
                @forelse($posts as $post)
                    <article class="card">
                        @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="card-image">
                        @else
                            <img src="https://placehold.co/1200x700?text=News+Image" alt="{{ $post->title }}" class="card-image">
                        @endif

                        <div class="card-body">
                            @if($post->category)
                                <span class="badge">{{ $post->category->name }}</span>
                            @endif

                            <h2 class="card-title">{{ $post->title }}</h2>
                            <p class="card-text">{{ $post->excerpt }}</p>

                            <div class="card-actions">
                                <a href="{{ route('posts.show', $post) }}" class="btn btn-primary">Смотреть</a>

                                @can('update', $post)
                                    <a href="{{ route('posts.edit', $post) }}" class="btn btn-dark">Редактировать</a>
                                @endcan

                                @can('delete', $post)
                                    <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Удалить</button>
                                    </form>
                                @endcan
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="form-card">
                        <p style="margin:0;">По вашему запросу новости не найдены.</p>
                    </div>
                @endforelse
            </div>

            @if($posts->hasPages())
                <div class="pagination-wrapper" style="margin-top: 28px; display: flex; align-items: center; gap: 10px; flex-wrap: wrap;">
                    @if($posts->onFirstPage())
                        <span class="btn btn-dark" style="opacity: .45; pointer-events: none;">Назад</span>
                    @else
                        <a href="{{ $posts->previousPageUrl() }}" class="btn btn-dark">Назад</a>
                    @endif

                    @foreach($posts->getUrlRange(1, $posts->lastPage()) as $page => $url)
                        @if($page == $posts->currentPage())
                            <span class="btn btn-primary">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="btn btn-dark">{{ $page }}</a>
                        @endif
                    @endforeach

                    @if($posts->hasMorePages())
                        <a href="{{ $posts->nextPageUrl() }}" class="btn btn-dark">Вперед</a>
                    @else
                        <span class="btn btn-dark" style="opacity: .45; pointer-events: none;">Вперед</span>
                    @endif
                </div>
            @endif
        </div>
    </section>
@endsection