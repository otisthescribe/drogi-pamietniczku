@extends('layouts.app')

@section('content')
<div class="text-center align-content-center">
    <h1 class="py-3">Rejestracja</h1>
    @if ($errors->any())
    <div class="alert alert-danger text-danger fw-bold my-3">
        🚫 {{ $errors->first() }} 🚫
    </div>
    @endif 
    @if(session('success'))
    <div class="alert alert-success text-success fw-bold my-3">
        🎉 {{ session('success') }} 🎉
    </div>
    @endif 
    <div>
        <form method="POST" action="{{ route('register') }}" >
            @csrf

            <!-- Name -->
            <div class="form-group">
                <label for="name">Imię</label>
                <input id="name" class="block mt-1 w-full form-control" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>
            <br>
            <!-- Email Address -->
            <div class="form-group">
                <label for="email">Adres email</label>
                <input id="email" class="block mt-1 w-full form-control" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>
            <br>
            <!-- Password -->
            <div class="form-group">
                <label for="password">Hasło</label>
                <input id="password" class="block mt-1 w-full form-control"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>
            <br>
            <!-- Confirm Password -->
            <div class="form-group">
                <label for="password_confirmation"> Powtórz hasło</label>
                <input id="password_confirmation" class="block mt-1 w-full form-control" type="password" name="password_confirmation" required autocomplete="new-password" />
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
    </div>

</div>
@stop