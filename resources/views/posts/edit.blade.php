@extends('layouts.app')

@section('content')
    <section class="hero">
        <h1 class="page-title">Редактирование новости</h1>
        <p class="page-subtitle">Измени текст, категорию и при необходимости замени изображение.</p>
    </section>

    <section class="form-card">
        @if ($errors->any())
            <div class="error-box">
                @foreach ($errors->all() as $error)
                    <p style="margin: 0 0 8px;">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('posts.update', $post) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="form-label" for="title">Заголовок</label>
                <input class="form-input" id="title" name="title" value="{{ old('title', $post->title) }}">
            </div>

            <div class="form-group">
                <label class="form-label" for="excerpt">Краткое описание</label>
                <textarea class="form-textarea" id="excerpt" name="excerpt">{{ old('excerpt', $post->excerpt) }}</textarea>
            </div>

            <div class="form-group">
                <label class="form-label" for="content">Полный текст</label>
                <textarea class="form-textarea" id="content" name="content">{{ old('content', $post->content) }}</textarea>
            </div>

            <div class="form-group">
                <label class="form-label" for="category_id">Категория</label>
                <select class="form-select" id="category_id" name="category_id">
                    <option value="">Выберите категорию</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id', $post->category_id) == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            @if($post->image)
                <div class="form-group">
                    <p class="form-label">Текущее изображение</p>
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" style="width: 240px; border-radius: 14px;">
                </div>
            @endif

            <div class="form-group">
                <label class="form-label" for="image">Новое изображение</label>
                <input class="form-input" type="file" id="image" name="image" accept=".jpg,.jpeg,.png,.webp">
            </div>

            <button type="submit" class="btn btn-primary">Сохранить изменения</button>
        </form>
    </section>
@endsection