@extends('layouts.app')

@section('content')
<h1>Logowanie</h1>
<br>
<form method="POST" action="{{ route('login') }}">
    @csrf
    <!-- Email Address -->
    <div class="form-group">
        <label for="email">Adres email</label>
        <input id="email" class="form-control block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>
    </br>
    <!-- Password -->
    <div class="form-group">
        <label for="password">Hasło</label>
        <input id="password" class="form-control block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
        <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>
    </br>
    <!-- Remember Me -->
    <div class="form-group inline-flex items-center">
        <input type="checkbox" class="form-check-input rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" id="remember_me" name="remember">
        <label class="form-check-label" for="remember_me">Zapamiętaj mnie</label>
    </div>
    </br>
    <div class="form-group flex items-center justify-end">
        <a class="custom-link" href="{{ route('password.request') }}">
            Zapomniałem hasła
        </a>
    </div>
    <button class="btn btn-custom mt-3">Zaloguj</button>
</form>
@stop