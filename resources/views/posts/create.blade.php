@extends('layouts.app')

@section('content')
    <section class="hero">
        <h1 class="page-title">Создание новости</h1>
        <p class="page-subtitle">Заполни поля, выбери категорию и загрузи изображение.</p>
    </section>

    <section class="form-card">
        @if ($errors->any())
            <div class="error-box">
                @foreach ($errors->all() as $error)
                    <p style="margin: 0 0 8px;">{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label class="form-label" for="title">Заголовок</label>
                <input class="form-input" id="title" name="title" value="{{ old('title') }}">
            </div>

            <div class="form-group">
                <label class="form-label" for="excerpt">Краткое описание</label>
                <textarea class="form-textarea" id="excerpt" name="excerpt">{{ old('excerpt') }}</textarea>
            </div>

            <div class="form-group">
                <label class="form-label" for="content">Полный текст</label>
                <textarea class="form-textarea" id="content" name="content">{{ old('content') }}</textarea>
            </div>

            <div class="form-group">
                <label class="form-label" for="category_id">Категория</label>
                <select class="form-select" id="category_id" name="category_id">
                    <option value="">Выберите категорию</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label class="form-label" for="image">Изображение</label>
                <input class="form-input" type="file" id="image" name="image" accept=".jpg,.jpeg,.png,.webp">
            </div>

            <button type="submit" class="btn btn-primary">Создать новость</button>
        </form>
    </section>
@endsection