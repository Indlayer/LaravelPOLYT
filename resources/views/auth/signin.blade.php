@extends('layouts.app')

@section('content')
    <h1>Регистрация</h1>

    @if ($errors->any())
        <div style="color: red; margin-bottom: 15px;">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('signin.submit') }}" method="POST">
        @csrf

        <div style="margin-bottom: 10px;">
            <label for="name">Имя</label><br>
            <input type="text" name="name" id="name" value="{{ old('name') }}">
        </div>

        <div style="margin-bottom: 10px;">
            <label for="email">Email</label><br>
            <input type="email" name="email" id="email" value="{{ old('email') }}">
        </div>

        <div style="margin-bottom: 10px;">
            <label for="password">Пароль</label><br>
            <input type="password" name="password" id="password">
        </div>

        <button type="submit">Отправить</button>
    </form>
@endsection