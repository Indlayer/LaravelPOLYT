@extends('layouts.app')

@section('content')
    <h1>Новости</h1>

    @foreach($news as $item)
        <div style="margin-bottom:20px;">
            <h3>{{ $item['title'] }}</h3>
            <p>{{ $item['description'] }}</p>

            <a href="/gallery/{{ $item['full_image'] }}">
                <img src="/images/{{ $item['preview_image'] }}" width="200">
            </a>
        </div>
    @endforeach
@endsection