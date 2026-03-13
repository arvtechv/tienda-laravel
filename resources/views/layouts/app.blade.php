<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>strAPPberry</title>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        * { font-family: 'Inter', sans-serif; margin: 0; padding: 0; box-sizing: border-box; }
        body { background: #F0F1F5; display: flex; min-height: 100vh; }

        /* SIDEBAR */
        .sidebar {
            width: 230px;
            min-height: 100vh;
            background: #353C59;
            display: flex;
            flex-direction: column;
            padding: 24px 0;
            position: fixed;
            left: 0; top: 0; bottom: 0;
            z-index: 100;
        }
        .sidebar-logo {
            padding: 0 24px 32px;
            border-bottom: 1px solid rgba(255,255,255,0.1);
            margin-bottom: 24px;
        }
        .sidebar-logo img {
            height: 48px;
        }
        .sidebar-logo-text {
            color: #fff;
            font-size: 1.4rem;
            font-weight: 800;
            letter-spacing: -0.5px;
        }
        .sidebar-logo-text span { color: #D15253; }
        .sidebar-nav {
            flex: 1;
            padding: 0 16px;
        }
        .sidebar-nav a {
            display: block;
            color: #fff;
            text-decoration: none;
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 500;
            margin-bottom: 4px;
            transition: background 0.2s;
        }
        .sidebar-nav a:hover { background: rgba(255,255,255,0.1); }
        .sidebar-nav a.active { background: rgba(255,255,255,0.15); }
        .sidebar-bottom {
            padding: 16px;
            border-top: 1px solid rgba(255,255,255,0.1);
            margin-top: auto;
        }
        .sidebar-bottom a {
            display: block;
            color: #fff;
            text-decoration: none;
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 1rem;
            font-weight: 500;
            transition: background 0.2s;
        }
        .sidebar-bottom a:hover { background: rgba(255,255,255,0.1); }

        /* MAIN CONTENT */
        .main-content {
            margin-left: 230px;
            flex: 1;
            padding: 24px;
            min-height: 100vh;
        }

        /* TOP BAR */
        .topbar {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            margin-bottom: 24px;
            gap: 16px;
        }
        .topbar-user {
            font-weight: 600;
            color: #353C59;
            font-size: 1rem;
        }
        .cart-icon {
            position: relative;
            color: #353C59;
            text-decoration: none;
            font-size: 1.4rem;
        }
        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: #353C59;
            color: #fff;
            border-radius: 50%;
            width: 18px;
            height: 18px;
            font-size: 0.65rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* CARD CONTENEDOR */
        .content-card {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
        }
        .content-header {
            background: #353C59;
            color: #fff;
            padding: 18px 28px;
            font-size: 1.1rem;
            font-weight: 600;
            text-align: center;
        }
        .content-body { padding: 28px; }

        /* INPUTS */
        .input-custom {
            width: 100%;
            background: #ECEEF3;
            border: none;
            border-radius: 10px;
            padding: 14px 18px;
            font-size: 0.95rem;
            color: #353C59;
            outline: none;
            margin-bottom: 14px;
        }
        .input-custom::placeholder { color: #9CA3AF; }
        .input-custom:focus { background: #e2e5ed; }

        /* BOTONES */
        .btn-primary-custom {
            background: #353C59;
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 13px 28px;
            font-weight: 600;
            font-size: 0.95rem;
            cursor: pointer;
            transition: background 0.2s;
            width: 100%;
        }
        .btn-primary-custom:hover { background: #2a3047; color: #fff; }

        /* TABLA ADMIN */
        .table-custom { width: 100%; border-collapse: collapse; }
        .table-custom thead tr {
            background: #353C59;
            color: #fff;
        }
        .table-custom thead th {
            padding: 14px 20px;
            font-size: 0.85rem;
            font-weight: 600;
            text-align: left;
        }
        .table-custom tbody tr {
            border-bottom: 1px solid #F0F1F5;
            transition: background 0.15s;
        }
        .table-custom tbody tr:nth-child(odd) { background: #F8F9FB; }
        .table-custom tbody tr:hover { background: #EEF0F5; }
        .table-custom tbody td {
            padding: 14px 20px;
            font-size: 0.9rem;
            color: #353C59;
            vertical-align: middle;
        }
        .price-red { color: #D15253; font-weight: 600; }
        .btn-edit {
            background: #353C59;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 7px 16px;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            margin-right: 6px;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        .btn-delete {
            background: #fff;
            color: #D15253;
            border: 1px solid #D15253;
            border-radius: 8px;
            padding: 7px 16px;
            font-size: 0.8rem;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }
        .btn-edit:hover { background: #2a3047; }
        .btn-delete:hover { background: #fff0f0; }

        /* PRODUCT CARDS CLIENTE */
        .product-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px; }
        .product-card-new {
            background: #ECEEF3;
            border-radius: 12px;
            overflow: hidden;
            padding: 12px;
        }
        .product-card-new img {
            width: 100%;
            height: 140px;
            object-fit: cover;
            border-radius: 8px;
            margin-bottom: 10px;
        }
        .product-card-new .p-name {
            font-size: 0.85rem;
            font-weight: 600;
            color: #353C59;
            margin-bottom: 4px;
        }
        .product-card-new .p-price {
            font-size: 0.9rem;
            color: #353C59;
            margin-bottom: 10px;
        }
        .btn-agregar-card {
            background: #353C59;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: 8px;
            width: 100%;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
        }
        .btn-agregar-card:hover { background: #2a3047; }

        /* FILTROS */
        .filter-tabs-new { display: flex; gap: 10px; margin-bottom: 20px; flex-wrap: wrap; }
        .filter-tab-new {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 8px 20px;
            font-size: 0.9rem;
            font-weight: 500;
            color: #353C59;
            cursor: pointer;
        }
        .filter-tab-new:hover, .filter-tab-new.active {
            background: #353C59;
            color: #fff;
            border-color: #353C59;
        }

        /* CARRITO LATERAL */
        .cart-sidebar {
            width: 300px;
            background: #F0F1F5;
            border-radius: 16px;
            padding: 20px;
            position: sticky;
            top: 24px;
        }
        .cart-sidebar h5 {
            font-weight: 700;
            color: #353C59;
            margin-bottom: 16px;
            font-size: 1rem;
        }
        .cart-item-row {
            display: flex;
            align-items: center;
            gap: 10px;
            background: #fff;
            border-radius: 10px;
            padding: 10px;
            margin-bottom: 10px;
        }
        .cart-item-row img {
            width: 50px;
            height: 40px;
            object-fit: cover;
            border-radius: 6px;
        }
        .cart-item-info { flex: 1; }
        .cart-item-info .name { font-size: 0.8rem; font-weight: 600; color: #353C59; }
        .cart-item-info .price { font-size: 0.8rem; color: #686B75; }
        .qty-controls {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.85rem;
            font-weight: 600;
        }
        .qty-btn {
            background: #F0F1F5;
            border: none;
            border-radius: 4px;
            width: 22px;
            height: 22px;
            cursor: pointer;
            font-weight: 700;
            color: #353C59;
        }
        .cart-total {
            display: flex;
            justify-content: space-between;
            font-weight: 700;
            color: #353C59;
            margin-top: 16px;
            font-size: 1rem;
        }

        /* PAGINACION */
        .pagination-custom {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 6px;
            margin-top: 20px;
        }
        .page-btn {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            border: none;
            background: #fff;
            color: #353C59;
            font-weight: 600;
            cursor: pointer;
            font-size: 0.85rem;
        }
        .page-btn.active { background: #353C59; color: #fff; }
        .page-btn:hover { background: #353C59; color: #fff; }

        /* LOGIN */
        .login-page {
            min-height: 100vh;
            background: #353C59;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
        }
        .login-box {
            background: #fff;
            border-radius: 16px;
            padding: 48px 40px;
            width: 100%;
            max-width: 480px;
            text-align: center;
        }
        .login-box .logo-text {
            font-size: 1.8rem;
            font-weight: 800;
            color: #353C59;
            margin-bottom: 32px;
        }
        .login-box .logo-text span { color: #D15253; }
    </style>
</head>
<body>
    @auth
    <div class="sidebar">
        <div class="sidebar-logo">
            <div class="sidebar-logo-text">str<span>APP</span>berry</div>
        </div>
        <nav class="sidebar-nav">
            <a href="{{ route('home') }}" class="{{ request()->is('/') ? 'active' : '' }}">Productos</a>
            @if(auth()->user()->hasRole('admin'))
                <a href="{{ route('products.create') }}">+ Agregar Producto</a>
            @endif
        </nav>
        <div class="sidebar-bottom">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" style="background:none; border:none; width:100%; text-align:left; color:#fff; padding:12px 16px; border-radius:8px; font-size:1rem; font-weight:500; cursor:pointer;">
                    Cerrar Sesión
                </button>
            </form>
        </div>
    </div>

    <div class="main-content">
        @if(auth()->user()->hasRole('cliente'))
        <div class="topbar">
            <span class="topbar-user">Hola {{ auth()->user()->name }}</span>
            <a href="{{ route('cart.index') }}" class="cart-icon">
                🛒
                @php $cartCount = \App\CartItem::where('user_id', auth()->id())->sum('quantity'); @endphp
                @if($cartCount > 0)
                    <span class="cart-badge">{{ $cartCount }}</span>
                @endif
            </a>
        </div>
        @endif

        @if(session('success'))
            <div class="alert alert-success mb-3">{{ session('success') }}</div>
        @endif

        @yield('content')
    </div>
    @else
        <div style="min-height:100vh; background:#353C59; display:flex; align-items:center; justify-content:center; width:100%;">
            @yield('content')
        </div>
    @endauth
</body>
</html>
