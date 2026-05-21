<!DOCTYPE html>
<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Lu Vendas</title>

    {{-- Bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    {{-- Google Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Lora:wght@400;500;600&display=swap"
        rel="stylesheet">

    {{-- CSS Global --}}
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    {{-- CSS específico de cada página --}}
    @stack('styles')

</head>

<body>

    <div class="layout">

        {{-- SIDEBAR --}}
        <aside class="sidebar">

            <div>
                <div class="logo">
                    <h2>
                        <i class="bi bi-flower1"></i>
                        Lu Vendas
                    </h2>
                </div>

                <nav class="menu">

                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </a>

                    <a href="{{ route('clientes.index') }}"
                        class="{{ request()->routeIs('clientes.*') ? 'active' : '' }}">
                        <i class="bi bi-people"></i>
                        <span>Clientes</span>
                    </a>

                    <a href="{{ route('compras.index') }}"
                        class="{{ request()->routeIs('compras.*') ? 'active' : '' }}">
                        <i class="bi bi-bag"></i>
                        <span>Compras</span>
                    </a>

                    <a href="{{ route('relatorios.index') }}"
                        class="{{ request()->routeIs('relatorios.*') ? 'active' : '' }}">
                        <i class="bi bi-bar-chart"></i>
                        <span>Relatórios</span>
                    </a>

                </nav>
            </div>

            <div class="logout">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">
                        <i class="bi bi-box-arrow-right"></i>
                        Sair
                    </button>
                </form>
            </div>

        </aside>

        {{-- CONTEÚDO --}}
        <main class="content">

            {{-- TOPBAR --}}
            <header class="topbar">

                <div>
                    {{-- MUDANÇA 3: eyebrow acima do título --}}
                    <p class="topbar-title-eyebrow">Lu Vendas</p>
                    <h1>@yield('title')</h1>
                </div>

                <div class="topbar-right">
                    <span>
                        <i class="bi bi-person-circle"></i>
                        {{ auth()->user()->name }}
                    </span>
                </div>

            </header>

            {{-- ALERTAS --}}
            @if(session('success'))
                <div class="alert alert-success mb-3">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('erro'))
                <div class="alert alert-danger mb-3">
                    {{ session('erro') }}
                </div>
            @endif

            {{-- CONTEÚDO DAS PÁGINAS --}}
            <section class="page-content">
                @yield('content')
            </section>

        </main>

    </div>

    {{-- Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    {{-- JS Global --}}
    <script src="{{ asset('js/app.js') }}"></script>

    {{-- JS específico de cada página --}}
    @stack('scripts')


</body>

</html>