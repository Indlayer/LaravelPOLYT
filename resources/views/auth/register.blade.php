@extends('layouts.app')

@section('content')
    <h1>Регистрация</h1>

    @if ($errors->any())
        <div style="color: red; margin-bottom: 15px;">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('register.submit') }}" method="POST">
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

        <div style="margin-bottom: 10px;">
            <label for="password_confirmation">Подтверждение пароля</label><br>
            <input type="password" name="password_confirmation" id="password_confirmation">
        </div>

        <button type="submit">Зарегистрироваться</button>
    </form>
@endsection