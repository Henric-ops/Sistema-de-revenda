@extends('layouts.app')

@section('title', 'Clientes')

@push('styles')
    <style>
        /* ── HEADER ─────────────────────────────────────── */
        .clientes-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .clientes-header-text h2 {
            font-size: 22px;
            font-weight: 700;
            color: #2a1a10;
            margin: 0 0 4px;
        }

        .clientes-header-text p {
            font-size: 13px;
            color: #b09080;
            margin: 0;
            font-weight: 500;
        }

        /* ── TABELA CARD ─────────────────────────────────── */
        .clientes-card {
            background: white;
            border-radius: 22px;
            border: 1px solid #f5ebe0;
            box-shadow: 0 4px 18px rgba(156, 74, 48, .06);
            overflow: hidden;
        }

        /* ── BARRA DE BUSCA ──────────────────────────────── */
        .clientes-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px 28px;
            border-bottom: 1px solid #f5ebe0;
            gap: 16px;
        }

        .clientes-search {
            position: relative;
            flex: 1;
            max-width: 320px;
        }

        .clientes-search i {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #c0a898;
            font-size: 15px;
        }

        .clientes-search input {
            width: 100%;
            padding: 10px 16px 10px 40px;
            border-radius: 12px;
            border: 1px solid #f0e8dc;
            background: #faf6f2;
            font-family: 'Outfit', sans-serif;
            font-size: 14px;
            color: #2a1a10;
            transition: .2s;
        }

        .clientes-search input:focus {
            outline: none;
            border-color: #9c4a30;
            background: white;
            box-shadow: 0 0 0 3px rgba(156, 74, 48, .1);
        }

        .clientes-search input::placeholder {
            color: #c0a898;
        }

        .clientes-count {
            font-size: 13px;
            color: #b09080;
            font-weight: 600;
            white-space: nowrap;
        }

        .clientes-count span {
            color: #9c4a30;
            font-weight: 800;
        }

        /* ── TABELA ──────────────────────────────────────── */
        .clientes-table {
            width: 100%;
            border-collapse: collapse;
        }

        .clientes-table thead tr {
            background: #fdf8f4;
            border-bottom: 1px solid #f5ebe0;
        }

        .clientes-table th {
            padding: 13px 20px;
            text-align: left;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .7px;
            color: #b09080;
            white-space: nowrap;
        }

        .clientes-table tbody tr {
            border-bottom: 1px solid #faf4ee;
            transition: background .15s;
        }

        .clientes-table tbody tr:last-child {
            border-bottom: none;
        }

        .clientes-table tbody tr:hover {
            background: #fdf8f5;
        }

        .clientes-table td {
            padding: 15px 20px;
            vertical-align: middle;
            font-size: 14px;
            color: #2a1a10;
        }

        .cliente-cell {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .cliente-avatar {
            width: 38px;
            height: 38px;
            border-radius: 12px;
            background: linear-gradient(135deg, #fde8d8, #fac8a8);
            color: #9c4a30;
            font-size: 15px;
            font-weight: 800;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .cliente-nome {
            font-weight: 700;
            font-size: 14px;
        }

        .celular-cell {
            display: flex;
            align-items: center;
            gap: 7px;
            color: #6a5040;
            font-size: 14px;
        }

        .badge-pill {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 700;
        }

        .badge-pill::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
        }

        .badge-pill.ativo {
            background: #e8fff0;
            color: #1a8a50;
        }

        .badge-pill.inativo {
            background: #ffeaea;
            color: #d94b4b;
        }

        .acoes-cell {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* ── BOTÕES DE AÇÃO ───────────────────────────── */

        .btn-ic {

            width: 38px;
            height: 38px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            border: none;
            cursor: pointer;

            text-decoration: none;
            position: relative;
            overflow: hidden;

            transition:
                transform .18s ease,
                box-shadow .18s ease,
                background .18s ease,
                color .18s ease;
        }

        /* brilho animado */
        .btn-ic::before {
            content: '';
            position: absolute;
            top: 0;
            left: -120%;
            width: 100%;
            height: 100%;
            background: linear-gradient(120deg,
                    transparent,
                    rgba(255, 255, 255, .45),
                    transparent);
            transition: .45s;
        }

        .btn-ic:hover::before {
            left: 120%;
        }

        /* hover geral */
        .btn-ic:hover {

            transform: translateY(-3px) scale(1.04);
        }

        /* clique */
        .btn-ic:active {
            transform: scale(.96);
        }

        /* ícones */
        .btn-ic i {
            font-size: 15px;
            position: relative;
            z-index: 2;
        }

        /* visualizar */
        .btn-ic.view {
            background: #edf5ff;
            color: #3a7bfd;
            box-shadow: 0 4px 10px rgba(58, 123, 253, .08);
        }


        .btn-ic.view:hover {
            background: #3a7bfd;
            color: #fff;
            box-shadow: 0 8px 18px rgba(58, 123, 253, .25);
        }

        /* editar */
        >>>>>>>3df00b6 (Voltando um commit para reajustar) .btn-ic.edit {
            background: #fff8e8;
            color: #d69b00;
            box-shadow: 0 4px 10px rgba(214, 155, 0, .08);
        }


        .btn-ic.edit:hover {
            background: #d69b00;
            color: #fff;
            box-shadow: 0 8px 18px rgba(214, 155, 0, .25);
        }

        /* excluir */
        .btn-ic.delete {
            background: #ffeaea;
            color: #d94b4b;
            box-shadow: 0 4px 10px rgba(217, 75, 75, .08);
        }


        .btn-ic.delete:hover {
            background: #d94b4b;
            color: #fff;
            box-shadow: 0 8px 18px rgba(217, 75, 75, .25);
        }

        /* whatsapp */
        .btn-ic.whatsapp {
            background: #e8faf0;
            color: #25D366;
            box-shadow: 0 4px 10px rgba(37, 211, 102, .10);
        }

        .btn-ic.whatsapp:hover {
            background: #25D366;
            color: #fff;
            box-shadow: 0 8px 18px rgba(37, 211, 102, .28);
        }

        /* reenviar acesso */
        .btn-ic.user {
            background: #efe9ff;
            color: #7a4dff;
            box-shadow: 0 4px 10px rgba(122, 77, 255, .10);
        }

        .btn-ic.user:hover {
            background: #7a4dff;
            color: #fff;
            box-shadow: 0 8px 18px rgba(122, 77, 255, .25);
        }

        >>>>>>>3df00b6 (Voltando um commit para reajustar)

        /* ── PAGINAÇÃO (clean e leve) ───────────────────── */
        .clientes-pagination-wrapper {
            display: flex;
            justify-content: center;
            padding: 18px 24px;
            border-top: 1px solid #f5ebe0;
            background: #fff;
        }

        .clientes-pagination-wrapper .pagination {
            display: flex !important;
            gap: 6px;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .clientes-pagination-wrapper .page-item .page-link {
            min-width: 36px;
            height: 36px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 10px;
            border: 1px solid #efe2d7;
            background: #faf6f2;
            color: #7a5040;
            font-weight: 700;
            font-size: 13px;
            text-decoration: none;
            transition: .2s;
        }

        .clientes-pagination-wrapper .page-item .page-link:hover {
            transform: translateY(-2px);
            background: #fdf4ee;
        }

        .clientes-pagination-wrapper .page-item.active .page-link {
            background: linear-gradient(135deg, #9c4a30, #c4693a);
            color: #fff;
            border: none;
        }

        .clientes-pagination-wrapper .page-item.disabled .page-link {
            opacity: .35;
        }

        /* Vazio */
        .clientes-empty {
            text-align: center;
            padding: 60px 20px;
            color: #c0a898;
        }

        .clientes-empty i {
            font-size: 40px;
            display: block;
            margin-bottom: 12px;
            opacity: .5;
        }

        .clientes-empty p {
            font-size: 15px;
            margin: 0;
        }

        .clientes-table tbody tr.hidden-row {
            display: none;
        }

        @media (max-width: 768px) {
            .clientes-toolbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .clientes-search {
                width: 100%;
                max-width: 100%;
            }

            .clientes-table {
                display: block;
                overflow-x: auto;
                white-space: nowrap;
            }
        }
    </style>
@endpush

@section('content')

    <div class="clientes-header">
        <div class="clientes-header-text">
            <h2>Lista de Clientes</h2>
            <p>Gerencie todos os clientes cadastrados.</p>
        </div>

        <a href="{{ route('clientes.create') }}" class="btn-primary-custom">
            <i class="bi bi-plus-circle"></i>
            Novo Cliente
        </a>
    </div>

    <div class="clientes-card">

        <div class="clientes-toolbar">
            <div class="clientes-search">
                <i class="bi bi-search"></i>
                <input type="text" id="busca-cliente" placeholder="Buscar por nome ou celular…">
            </div>

            <span class="clientes-count">
                <span id="total-visivel">{{ $clientes->total() }}</span> clientes
            </span>
        </div>

        @if($clientes->isNotEmpty())

            <table class="clientes-table" id="tabela-clientes">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Celular</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($clientes as $cliente)
                                <tr data-busca="{{ strtolower($cliente->nome . ' ' . $cliente->celular) }}">

                                    <td>
                                        <div class="cliente-cell">
                                            <div class="cliente-avatar">
                                                {{ strtoupper(substr($cliente->nome, 0, 1)) }}
                                            </div>
                                            <span class="cliente-nome">{{ $cliente->nome }}</span>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="celular-cell">
                                            <i class="bi bi-telephone"></i>
                                            {{ $cliente->celular }}
                                        </div>
                                    </td>

                                    <td>
                                        @if($cliente->ativo)
                                            <span class="badge-pill ativo">Ativo</span>
                                        @else
                                            <span class="badge-pill inativo">Inativo</span>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="acoes-cell">


                                            {{-- WhatsApp cobrança --}}
                                            <button type="button" class="btn-ic whatsapp" title="Cobrar via WhatsApp"
                                                data-telefone="{{ e($cliente->celular) }}" data-nome="{{ e($cliente->nome) }}"
                                                data-valor="{{ number_format($cliente->compras->sum('saldo_restante'), 2, ',', '.') }}"
                                                data-produtos="{{ e($cliente->compras->pluck('descricao_produtos')->implode(', ')) }}"
                                                onclick="cobrarWhatsApp(
                            this.dataset.telefone,
                            this.dataset.nome,
                            this.dataset.valor,
                            this.dataset.produtos
                        )">
                                                <i class="bi bi-whatsapp"></i>
                                            </button>

                                            {{-- Visualizar --}}
                                            <a href="{{ route('clientes.show', $cliente->id) }}" class="btn-ic view" title="Visualizar">

                                                <i class="bi bi-eye"></i>
                                            </a>

                                            {{-- Editar --}}
                                            <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn-ic edit" title="Editar">

                                                <i class="bi bi-pencil"></i>
                                            </a>

                                            {{-- Reenviar acesso --}}
                                            <a href="{{ route('clientes.reenviar-acesso', $cliente->id) }}" class="btn-ic user"
                                                title="Reenviar acesso via WhatsApp">

                                                <i class="bi bi-send"></i>
                                            </a>

                                            {{-- Excluir --}}
                                            <form action="{{ route('clientes.destroy', $cliente->id) }}" method="POST"
                                                onsubmit="return confirm('Deseja excluir este cliente?')">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn-ic delete" title="Excluir">
                                                    <i class="bi bi-trash"></i>
                                                </button>

                                            </form>

                                        </div>
                                    </td>

                                </tr>
                    @endforeach
                </tbody>
            </table>

            {{-- PAGINAÇÃO NOVA --}}
            <div class="clientes-pagination-wrapper">
                {{ $clientes->withQueryString()->links() }}
            </div>

        @else
            <div class="clientes-empty">
                <i class="bi bi-people"></i>
                <p>Nenhum cliente cadastrado ainda.</p>
            </div>
        @endif

    </div>

@endsection

@push('scripts')
    <script>
        const input = document.getElementById('busca-cliente');
        const rows = document.querySelectorAll('#tabela-clientes tbody tr');
        const counter = document.getElementById('total-visivel');

        input.addEventListener('input', () => {
            const q = input.value.toLowerCase().trim();
            let visivel = 0;

            rows.forEach(row => {
                const ok = row.dataset.busca.includes(q);
                row.classList.toggle('hidden-row', !ok);
                if (ok) visivel++;
            });

            counter.textContent = visivel;
        });
    </script>
@endpush