<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'TechStore') }}</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; }
        body { background-color: #f8fafc; }

        /* NAVBAR */
        .navbar-custom {
            background: #fff;
            border-bottom: 1px solid #e5e7eb;
            padding: 12px 0;
        }
        .navbar-brand-custom {
            font-weight: 700;
            font-size: 1.2rem;
            color: #1e293b !important;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .navbar-brand-custom .brand-icon {
            color: #2563eb;
        }
        .btn-navbar-login {
            background: #2563eb;
            color: #fff !important;
            border-radius: 8px;
            padding: 8px 20px;
            font-weight: 600;
            font-size: 0.9rem;
        }
        .btn-navbar-login:hover { background: #1d4ed8; }
        .nav-icon-btn {
            color: #64748b;
            font-size: 1.3rem;
            padding: 6px 12px;
        }

        /* HERO */
        .hero-section {
            text-align: center;
            padding: 60px 0 40px;
        }
        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #eff6ff;
            color: #2563eb;
            border-radius: 20px;
            padding: 6px 16px;
            font-size: 0.85rem;
            font-weight: 500;
            margin-bottom: 16px;
            border: 1px solid #bfdbfe;
        }
        .hero-title {
            font-size: 2.8rem;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 12px;
        }
        .hero-subtitle {
            color: #64748b;
            font-size: 1rem;
            max-width: 500px;
            margin: 0 auto;
        }

        /* FILTROS */
        .filter-bar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 16px 0;
            border-bottom: 1px solid #e5e7eb;
            margin-bottom: 30px;
            flex-wrap: wrap;
            gap: 12px;
        }
        .filter-tabs { display: flex; gap: 8px; flex-wrap: wrap; }
        .filter-tab {
            padding: 8px 18px;
            border-radius: 8px;
            border: 1px solid #e5e7eb;
            background: #fff;
            color: #64748b;
            font-size: 0.9rem;
            cursor: pointer;
            font-weight: 500;
            transition: all 0.2s;
        }
        .filter-tab.active, .filter-tab:hover {
            background: #2563eb;
            color: #fff;
            border-color: #2563eb;
        }
        .search-box {
            display: flex;
            align-items: center;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 8px 14px;
            gap: 8px;
            min-width: 220px;
        }
        .search-box input {
            border: none;
            outline: none;
            font-size: 0.9rem;
            color: #374151;
            width: 100%;
            background: transparent;
        }
        .search-box svg { color: #9ca3af; }

        /* CARDS */
        .product-card {
            background: #fff;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            overflow: hidden;
            transition: box-shadow 0.2s, transform 0.2s;
        }
        .product-card:hover {
            box-shadow: 0 8px 25px rgba(0,0,0,0.1);
            transform: translateY(-2px);
        }
        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .product-card-body { padding: 16px; }
        .product-brand {
            font-size: 0.75rem;
            font-weight: 600;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            margin-bottom: 4px;
        }
        .product-name {
            font-size: 1rem;
            font-weight: 600;
            color: #1e293b;
            margin-bottom: 12px;
        }
        .product-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .product-price {
            font-size: 1.2rem;
            font-weight: 700;
            color: #0f172a;
        }
        .btn-agregar {
            background: #f97316;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 8px 16px;
            font-size: 0.85rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            transition: background 0.2s;
        }
        .btn-agregar:hover { background: #ea6c0a; color: #fff; }
        .btn-admin-edit {
            background: #fef3c7;
            color: #92400e;
            border: none;
            border-radius: 8px;
            padding: 6px 12px;
            font-size: 0.8rem;
            font-weight: 600;
        }
        .btn-admin-delete {
            background: #fee2e2;
            color: #991b1b;
            border: none;
            border-radius: 8px;
            padding: 6px 12px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        /* LOGIN */
        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-card {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 16px;
            padding: 40px;
            width: 100%;
            max-width: 400px;
        }
        .login-logo {
            text-align: center;
            margin-bottom: 24px;
        }
        .login-logo h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #1e293b;
        }
        .login-logo p { color: #94a3b8; font-size: 0.9rem; }
        .form-label-custom {
            font-size: 0.85rem;
            font-weight: 500;
            color: #374151;
            margin-bottom: 6px;
        }
        .form-control-custom {
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 10px 14px;
            font-size: 0.9rem;
            width: 100%;
            margin-bottom: 16px;
            outline: none;
            transition: border 0.2s;
        }
        .form-control-custom:focus { border-color: #2563eb; }
        .btn-login-submit {
            background: #2563eb;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 12px;
            width: 100%;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
        }
        .btn-login-submit:hover { background: #1d4ed8; }

        /* CARRITO */
        .cart-table { background: #fff; border-radius: 12px; overflow: hidden; }
        .cart-total-box {
            background: #fff;
            border-radius: 12px;
            border: 1px solid #e5e7eb;
            padding: 24px;
        }
    </style>
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-custom">
            <div class="container">
                <a class="navbar-brand navbar-brand-custom" href="{{ route('home') }}">
                    <span class="brand-icon">🖥️</span> TechStore
                </a>

                <div class="ml-auto d-flex align-items-center gap-3">
                    @auth
                        @if(auth()->user()->hasRole('admin'))
                            <a href="{{ route('products.create') }}"
                               class="btn btn-sm btn-outline-primary font-weight-600">
                                + Agregar Producto
                            </a>
                        @endif

                        @if(auth()->user()->hasRole('cliente'))
                            <a href="{{ route('cart.index') }}" class="nav-icon-btn position-relative">
                                🛒
                                @php
                                    $cartCount = \App\CartItem::where('user_id', auth()->id())->sum('quantity');
                                @endphp
                                @if($cartCount > 0)
                                    <span style="
                                        position: absolute;
                                        top: -6px;
                                        right: -6px;
                                        background: #ef4444;
                                        color: white;
                                        border-radius: 50%;
                                        width: 18px;
                                        height: 18px;
                                        font-size: 0.7rem;
                                        font-weight: 700;
                                        display: flex;
                                        align-items: center;
                                        justify-content: center;
                                        line-height: 1;
                                    ">{{ $cartCount }}</span>
                                @endif
                            </a>
                        @endif

                        <div class="dropdown">
                            <button class="btn btn-sm btn-light dropdown-toggle" data-toggle="dropdown">
                                👤 {{ auth()->user()->name }}
                            </button>
                            <div class="dropdown-menu dropdown-menu-right">
                                <form action="{{ route('logout') }}" method="POST">
                                    @csrf
                                    <button class="dropdown-item text-danger">Cerrar sesión</button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="btn-navbar-login">
                            👤 Ingresar
                        </a>
                    @endauth
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>
    </div>
</body>
</html>
