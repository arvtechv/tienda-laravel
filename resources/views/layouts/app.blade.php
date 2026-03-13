<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Mi Tienda') }}</title>

    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">

        <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ route('home') }}">🛒 Mi Tienda</a>
                <div class="collapse navbar-collapse">
                    <ul class="navbar-nav ml-auto">

                        @auth
                            @if(auth()->user()->hasRole('admin'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('products.create') }}">+ Agregar Producto</a>
                                </li>
                            @endif

                            @if(auth()->user()->hasRole('cliente'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('cart.index') }}">🛒 Carrito</a>
                                </li>
                            @endif

                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('logout') }}"
                                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    Salir
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">Registro</a>
                            </li>
                        @endauth

                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>

    </div>
</body>
</html>
