@extends('layouts.app')

@section('content')
<h1>Rejestracja</h1>
<br>
<form method="POST" action="{{ route('register') }}">
    @csrf

    <!-- Name -->
    <div class="form-group">
        <label for="name">Imię</label>
        <input id="name" class="block mt-1 w-full form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
        <x-input-error :messages="$errors->get('name')" class="mt-2" />
    </div>
    <br>
    <!-- Email Address -->
    <div class="form-group">
        <label for="email">Adres email</label>
        <input id="email" class="block mt-1 w-full form-control" type="email" name="email" :value="old('email')" required autocomplete="username" />
        <x-input-error :messages="$errors->get('email')" class="mt-2" />
    </div>
    <br>
    <!-- Password -->
    <div class="form-group">
        <label for="password">Hasło</label>
        <input id="password" class="block mt-1 w-full form-control"
                        type="password"
                        name="password"
                        required autocomplete="new-password" />

        <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>
    <br>
    <!-- Confirm Password -->
    <div class="form-group">
        <label for="password_confirmation"> Powtórz hasło</label>
        <input id="password_confirmation" class="block mt-1 w-full form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
    </div>
    <br>
    <div class="flex items-center justify-end">
        <a class="custom-link" href="{{ route('login') }}">
            Mam już konto
        </a>
    </div>
    <br>
    <button class="btn btn-custom">
        Zarejestruj
    </button>
</form>
@stop