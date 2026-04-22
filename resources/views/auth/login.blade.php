@extends('layouts.app')

@section('content')
    <h1>Вход</h1>

    @if ($errors->any())
        <div style="color: red; margin-bottom: 15px;">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form action="{{ route('login.submit') }}" method="POST">
        @csrf

        <div style="margin-bottom: 10px;">
            <label for="email">Email</label><br>
            <input type="email" name="email" id="email" value="{{ old('email') }}">
        </div>

        <div style="margin-bottom: 10px;">
            <label for="password">Пароль</label><br>
            <input type="password" name="password" id="password">
        </div>

        <button type="submit">Войти</button>
    </form>
@endsection