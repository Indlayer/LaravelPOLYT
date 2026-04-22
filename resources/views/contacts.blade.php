@extends('layouts.app')

@section('content')
    <h1>Контакты</h1>

    <p>Компания: {{ $contacts['company'] }}</p>
    <p>Адрес: {{ $contacts['address'] }}</p>
    <p>Телефон: {{ $contacts['phone'] }}</p>
    <p>Email: {{ $contacts['email'] }}</p>
@endsection