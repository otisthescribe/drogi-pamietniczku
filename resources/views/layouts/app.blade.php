<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="shortcut icon" href="{{ asset('img/notebook.png') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

        <!-- Bootstrap -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/events.css'])
    </head>
    <body>
        <!-- Navbar -->
        <nav class="navbar navbar-expand-sm fixed-top px-3">
            <!-- Left side: Logo and Welcome message -->
            <div class="navbar-nav me-auto d-flex">
                <a class="navbar-brand d-flex" href="{{ route('intro') }}">
                    <img src="{{ asset('img/notebook.png') }}" width="30" height="30" class="d-inline-block align-top" alt="logo">
                </a>
                @auth
                <span class="navbar-text font-weight-bold">
                    Witaj, {{ Auth::user()->name }}!
                </span>
                @else
                <span class="navbar-text font-weight-bold">
                    Witaj, Anonimowy Czytelniku!
                </span>
                @endif
            </div>

            <!-- Right side: Authentication links -->
            <div class="navbar-nav ms-auto d-flex">
                <li class="nav-item"><a class="nav-link" href="{{ route('dashboard') }}">Panel</a></li>
                @auth
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.events') }}">Wydarzenia</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('admin.categories') }}">Kategorie</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('profile.edit') }}">Ustawienia konta</a></li>
                <li class="nav-item">
                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                        @csrf
                        <a class="nav-link " href="{{ route('logout') }}" onclick="event.preventDefault();this.closest('form').submit();">Wyloguj</a>
                    </form>
                </li>
                @else
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('login') }}">Logowanie</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('register') }}">Rejestracja</a>
                </li>
                @endif
            </div>
        </nav>

        <!-- Page Content -->
        <div class="w-100 p-3 page-content">
            @yield('content')
        </div>

        <!-- Footer -->
        <footer class="text-center py-2 fixed-bottom">
            <p>&copy; {{ date('Y') }} Drogi Pamiętniczku... Wszystkie prawa zastrzeżone.</p>
        </footer>

        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>
