@extends('layouts.app')

@section('content')
    <h1>Просмотр изображения</h1>

    <img src="/images/{{ $image }}" width="500">
@endsection