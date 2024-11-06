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

        <!-- Bootstrap JavaScript Bundle -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>
