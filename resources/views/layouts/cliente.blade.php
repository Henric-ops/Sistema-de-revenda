<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Lu Vendas') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Lora:ital,wght@0,400;0,600;1,400&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @stack('styles')

    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        :root {
            --brand: #9c4a30;
            --brand-dark: #7a3520;
            --brand-light: #c4693a;
            --brand-pale: #fdf4ee;
            --brand-soft: #f5e8dc;
            --sidebar-w: 260px;
            --topbar-h: 64px;
            --text-dark: #2a1a10;
            --text-mid: #6a5040;
            --text-muted: #b09080;
            --bg: #faf4ee;
            --white: #ffffff;
            --radius: 16px;
            --shadow: 0 4px 20px rgba(156, 74, 48, .08);
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: var(--bg);
            color: var(--text-dark);
            margin: 0;
            min-height: 100vh;
        }

        /* ── SIDEBAR ─────────────────────────────────────── */
        .cl-sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: var(--sidebar-w);
            height: 100vh;
            background: var(--white);
            border-right: 1px solid var(--brand-soft);
            display: flex;
            flex-direction: column;
            z-index: 200;
            transition: transform .3s ease;
        }

        .cl-sidebar-logo {
            padding: 28px 24px 20px;
            border-bottom: 1px solid var(--brand-soft);
        }

        .cl-logo-inner {
            display: flex;
            align-items: center;
            gap: 10px;
            font-family: 'Lora', serif;
            font-size: 22px;
            font-weight: 600;
            color: var(--brand);
        }

        .cl-logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, var(--brand), var(--brand-light));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 20px;
            flex-shrink: 0;
        }

        .cl-logo-sub {
            font-size: 11px;
            color: var(--text-muted);
            font-family: 'Outfit', sans-serif;
            font-weight: 500;
            letter-spacing: .5px;
            margin-top: 1px;
        }

        /* avatar do cliente */
        .cl-user-panel {
            padding: 20px 24px;
            border-bottom: 1px solid var(--brand-soft);
        }

        .cl-avatar-row {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .cl-avatar {
            width: 44px;
            height: 44px;
            border-radius: 14px;
            background: linear-gradient(135deg, #fde8d8, #fac8a8);
            color: var(--brand);
            font-size: 18px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .cl-user-name {
            font-size: 14px;
            font-weight: 700;
            color: var(--text-dark);
            line-height: 1.2;
        }

        .cl-user-label {
            font-size: 11px;
            color: var(--text-muted);
            font-weight: 500;
        }

        /* NAV */
        .cl-nav {
            flex: 1;
            padding: 16px 12px;
            overflow-y: auto;
        }

        .cl-nav-label {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--text-muted);
            padding: 0 12px;
            margin: 12px 0 6px;
        }

        .cl-nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 14px;
            border-radius: 12px;
            text-decoration: none;
            color: var(--text-mid);
            font-size: 14px;
            font-weight: 600;
            transition: all .18s ease;
            margin-bottom: 2px;
        }

        .cl-nav-item i {
            font-size: 17px;
            width: 20px;
            text-align: center;
            flex-shrink: 0;
        }

        .cl-nav-item:hover {
            background: var(--brand-pale);
            color: var(--brand);
        }

        .cl-nav-item.active {
            background: linear-gradient(135deg, #fde8d8, #fcd4bc);
            color: var(--brand);
        }

        .cl-nav-item .nav-badge {
            margin-left: auto;
            background: var(--brand);
            color: white;
            font-size: 10px;
            font-weight: 800;
            padding: 2px 7px;
            border-radius: 20px;
        }

        /* LOGOUT no fundo da sidebar */
        .cl-sidebar-footer {
            padding: 16px 12px;
            border-top: 1px solid var(--brand-soft);
        }

        .cl-logout-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            padding: 11px 14px;
            border-radius: 12px;
            border: none;
            background: #fff0ed;
            color: #c93a3a;
            font-size: 14px;
            font-weight: 600;
            font-family: 'Outfit', sans-serif;
            cursor: pointer;
            transition: all .18s ease;
        }

        .cl-logout-btn:hover {
            background: #ffe0dc;
        }

        /* ── TOPBAR MOBILE ───────────────────────────────── */
        .cl-topbar {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: var(--topbar-h);
            background: var(--white);
            border-bottom: 1px solid var(--brand-soft);
            align-items: center;
            justify-content: space-between;
            padding: 0 20px;
            z-index: 300;
        }

        .cl-topbar-logo {
            font-family: 'Lora', serif;
            font-size: 20px;
            font-weight: 600;
            color: var(--brand);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .cl-hamburger {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            border: none;
            background: var(--brand-pale);
            color: var(--brand);
            font-size: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        /* overlay mobile */
        .cl-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(42, 26, 16, .35);
            z-index: 190;
        }

        .cl-overlay.show {
            display: block;
        }

        /* ── MAIN ────────────────────────────────────────── */
        .cl-main {
            margin-left: var(--sidebar-w);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .cl-page-header {
            padding: 36px 40px 0;
        }

        .cl-page-title {
            font-size: 26px;
            font-weight: 800;
            color: var(--text-dark);
            margin: 0 0 4px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .cl-page-subtitle {
            font-size: 14px;
            color: var(--text-muted);
            font-weight: 500;
            margin: 0;
        }

        .cl-content {
            flex: 1;
            padding: 28px 40px 40px;
        }

        /* Alertas */
        .cl-alert {
            border-radius: 14px;
            padding: 14px 18px;
            margin-bottom: 20px;
            border: none;
            font-size: 14px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .cl-alert-success {
            background: #f0faf5;
            color: #1a7a4a;
            border-left: 4px solid #1a7a4a;
        }

        .cl-alert-danger {
            background: #fff0f0;
            color: #c93a3a;
            border-left: 4px solid #c93a3a;
        }

        /* ── RESPONSIVO ──────────────────────────────────── */
        @media (max-width: 900px) {
            .cl-topbar {
                display: flex;
            }

            .cl-sidebar {
                transform: translateX(calc(-1 * var(--sidebar-w)));
                top: 0;
            }

            .cl-sidebar.open {
                transform: translateX(0);
            }

            .cl-main {
                margin-left: 0;
                padding-top: var(--topbar-h);
            }

            .cl-page-header {
                padding: 24px 20px 0;
            }

            .cl-content {
                padding: 20px 20px 32px;
            }
        }
    </style>
</head>

<body>

    {{-- OVERLAY mobile --}}
    <div class="cl-overlay" id="cl-overlay" onclick="closeSidebar()"></div>

    {{-- TOPBAR MOBILE --}}
    <header class="cl-topbar">
        <div class="cl-topbar-logo">
            <i class="bi bi-flower1"></i> Lu Vendas
        </div>
        <button class="cl-hamburger" onclick="openSidebar()">
            <i class="bi bi-list"></i>
        </button>
    </header>

    {{-- SIDEBAR --}}
    <aside class="cl-sidebar" id="cl-sidebar">

        <div class="cl-sidebar-logo">
            <div class="cl-logo-inner">
                <div class="cl-logo-icon"><i class="bi bi-flower1"></i></div>
                <div>
                    Lu Vendas
                    <div class="cl-logo-sub">Área do Cliente</div>
                </div>
            </div>
        </div>

        <div class="cl-user-panel">
            <div class="cl-avatar-row">
                <div class="cl-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>
                <div>
                    <div class="cl-user-name">{{ auth()->user()->name }}</div>
                    <div class="cl-user-label">Cliente</div>
                </div>
            </div>
        </div>

        <nav class="cl-nav">
            <div class="cl-nav-label">Menu</div>

            <a href="{{ route('cliente.dashboard') }}"
                class="cl-nav-item {{ request()->routeIs('cliente.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i>
                Dashboard
            </a>
        </nav>

        <div class="cl-sidebar-footer">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="cl-logout-btn">
                    <i class="bi bi-box-arrow-right"></i>
                    Sair da conta
                </button>
            </form>
        </div>

    </aside>

    {{-- MAIN --}}
    <main class="cl-main">

        <div class="cl-page-header">
            <h1 class="cl-page-title">@yield('title', 'Minha Área')</h1>
            <p class="cl-page-subtitle">@stack('header-subtitle')</p>
        </div>

        <div class="cl-content">

            @if(session('success'))
                <div class="cl-alert cl-alert-success">
                    <i class="bi bi-check-circle-fill"></i>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('erro'))
                <div class="cl-alert cl-alert-danger">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    {{ session('erro') }}
                </div>
            @endif

            @yield('content')

        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>

    <script>
        function openSidebar() {
            document.getElementById('cl-sidebar').classList.add('open');
            document.getElementById('cl-overlay').classList.add('show');
        }
        function closeSidebar() {
            document.getElementById('cl-sidebar').classList.remove('open');
            document.getElementById('cl-overlay').classList.remove('show');
        }
    </script>

    @stack('scripts')

</body>

</html>