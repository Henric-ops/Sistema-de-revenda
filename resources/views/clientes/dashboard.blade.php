@extends('layouts.cliente')

@section('title')
    <i class="bi bi-speedometer2" style="color:#9c4a30;font-size:24px;"></i>
        Meu Dashboard
@endsection

@push('header-subtitle')
    Acompanhe suas compras, pagamentos e saldo em tempo real
@endpush

@push('styles')
    <style>
        /* ── GRID DE CARDS ───────────────────────────────── */
        .resumo-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 18px;
            margin-bottom: 32px;
        }

        .resumo-card {
            background: white;
            border-radius: 20px;
            padding: 22px 24px;
            border: 1px solid #f0e6dc;
            box-shadow: 0 4px 18px rgba(156,74,48,.06);
            position: relative;
            overflow: hidden;
            transition: transform .2s, box-shadow .2s;
        }

        .resumo-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(156,74,48,.12);
        }

        .resumo-card-deco {
            position: absolute;
            bottom: -18px; right: -18px;
            width: 80px; height: 80px;
            border-radius: 50%;
            opacity: .07;
        }

        .resumo-card-top {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 14px;
        }

        .resumo-card-label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .7px;
            color: #b09080;
        }

        .resumo-card-icon {
            width: 40px; height: 40px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 18px;
        }

        .resumo-card-value {
            font-size: 26px;
            font-weight: 800;
            letter-spacing: -1px;
            line-height: 1;
            margin-bottom: 4px;
        }

        .resumo-card-sub {
            font-size: 12px;
            color: #b09080;
            font-weight: 500;
        }

        /* variantes de cor */
        .card-azul  .resumo-card-value { color: #2a5fd8; }
        .card-azul  .resumo-card-icon  { background: #eef3ff; color: #2a5fd8; }
        .card-azul  .resumo-card-deco  { background: #2a5fd8; }

        .card-verde .resumo-card-value { color: #1a7a4a; }
        .card-verde .resumo-card-icon  { background: #edfaf4; color: #1a7a4a; }
        .card-verde .resumo-card-deco  { background: #1a7a4a; }

        .card-amber .resumo-card-value { color: #a06800; }
        .card-amber .resumo-card-icon  { background: #fff8e8; color: #a06800; }
        .card-amber .resumo-card-deco  { background: #a06800; }

        .card-roxo  .resumo-card-value { color: #6a30c8; }
        .card-roxo  .resumo-card-icon  { background: #f3eeff; color: #6a30c8; }
        .card-roxo  .resumo-card-deco  { background: #6a30c8; }

        /* ── BARRA DE SAÚDE FINANCEIRA ───────────────────── */
        .saude-card {
            background: linear-gradient(135deg, #9c4a30, #c4693a);
            border-radius: 20px;
            padding: 24px 28px;
            color: white;
            margin-bottom: 32px;
            display: flex;
            align-items: center;
            gap: 28px;
            box-shadow: 0 8px 28px rgba(156,74,48,.25);
        }

        .saude-icon {
            width: 56px; height: 56px;
            background: rgba(255,255,255,.18);
            border-radius: 16px;
            display: flex; align-items: center; justify-content: center;
            font-size: 26px;
            flex-shrink: 0;
        }

        .saude-body { flex: 1; }

        .saude-title {
            font-size: 13px;
            font-weight: 600;
            opacity: .8;
            text-transform: uppercase;
            letter-spacing: .6px;
            margin-bottom: 8px;
        }

        .saude-bar-track {
            height: 10px;
            background: rgba(255,255,255,.25);
            border-radius: 99px;
            overflow: hidden;
            margin-bottom: 8px;
        }

        .saude-bar-fill {
            height: 100%;
            border-radius: 99px;
            background: white;
            transition: width .8s ease;
        }

        .saude-info {
            display: flex;
            justify-content: space-between;
            font-size: 13px;
            opacity: .9;
            font-weight: 600;
        }

        .saude-pct {
            font-size: 32px;
            font-weight: 800;
            flex-shrink: 0;
            line-height: 1;
        }

        /* ── SEÇÕES ──────────────────────────────────────── */
        .cl-section { margin-bottom: 32px; }

        .cl-section-header {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 18px;
            padding-bottom: 14px;
            border-bottom: 2px solid #f5ebe0;
        }

        .cl-section-icon {
            width: 32px; height: 32px;
            border-radius: 10px;
            background: linear-gradient(135deg, #9c4a30, #c4693a);
            color: white;
            display: flex; align-items: center; justify-content: center;
            font-size: 15px;
        }

        .cl-section-title {
            font-size: 17px;
            font-weight: 700;
            color: #2a1a10;
            margin: 0;
        }

        .cl-section-badge {
            margin-left: auto;
            font-size: 11px;
            background: #faf0ea;
            color: #9c4a30;
            font-weight: 700;
            padding: 5px 12px;
            border-radius: 20px;
        }

        /* ── COMPRA CARD ─────────────────────────────────── */
        .compras-lista { display: flex; flex-direction: column; gap: 12px; }

        .compra-card {
            background: white;
            border-radius: 18px;
            border: 1px solid #f0e6dc;
            box-shadow: 0 2px 12px rgba(156,74,48,.05);
            overflow: hidden;
            transition: box-shadow .2s;
        }

        .compra-card:hover { box-shadow: 0 8px 24px rgba(156,74,48,.1); }

        .compra-card-head {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 18px 22px;
            cursor: pointer;
            user-select: none;
            transition: background .15s;
        }

        .compra-card-head:hover { background: #fdf8f5; }

        .compra-num {
            width: 40px; height: 40px;
            border-radius: 12px;
            background: linear-gradient(135deg, #fde8d8, #fac8a8);
            display: flex; align-items: center; justify-content: center;
            font-weight: 800;
            font-size: 14px;
            color: #9c4a30;
            flex-shrink: 0;
        }

        .compra-info { flex: 1; min-width: 0; }

        .compra-info-title {
            font-size: 14px;
            font-weight: 700;
            color: #2a1a10;
            margin-bottom: 3px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .compra-info-meta {
            font-size: 12px;
            color: #b09080;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .compra-right {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
        }

        .compra-valor-num {
            font-size: 16px;
            font-weight: 800;
            color: #2a1a10;
            text-align: right;
        }

        .compra-valor-label {
            font-size: 11px;
            color: #b09080;
            font-weight: 600;
            text-align: right;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 11px;
            border-radius: 10px;
            font-size: 11px;
            font-weight: 700;
            white-space: nowrap;
        }

        .status-badge::before {
            content: '';
            width: 5px; height: 5px;
            border-radius: 50%;
            background: currentColor;
        }

        .status-pago     { background: #f0faf5; color: #1a7a4a; }
        .status-parcial  { background: #fffbf0; color: #a06800; }
        .status-pendente { background: #fff5f0; color: #9c4a30; }

        .compra-chevron {
            color: #c0a898;
            font-size: 14px;
            transition: transform .25s ease;
        }

        .compra-card.open .compra-chevron { transform: rotate(180deg); }

        /* corpo expansível */
        .compra-body {
            max-height: 0;
            overflow: hidden;
            transition: max-height .35s ease;
        }

        .compra-card.open .compra-body { max-height: 500px; }

        .compra-body-inner {
            padding: 0 22px 20px;
            border-top: 1px solid #f5ebe0;
        }

        .progresso-wrap { padding-top: 16px; margin-bottom: 16px; }

        .progresso-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 7px;
        }

        .progresso-label {
            font-size: 11px;
            font-weight: 700;
            color: #8a7060;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .progresso-pct {
            font-size: 13px;
            font-weight: 800;
            color: #2a1a10;
        }

        .progresso-track {
            height: 8px;
            background: #f5ebe0;
            border-radius: 99px;
            overflow: hidden;
            margin-bottom: 7px;
        }

        .progresso-fill {
            height: 100%;
            border-radius: 99px;
            background: linear-gradient(90deg, #9c4a30, #c4693a);
            transition: width .7s ease;
        }

        .progresso-fill.completo { background: linear-gradient(90deg, #1a7a4a, #28a865); }

        .progresso-vals {
            display: flex;
            justify-content: space-between;
            font-size: 12px;
            color: #b09080;
            font-weight: 600;
        }

        .progresso-vals span:last-child { color: #9c4a30; font-weight: 700; }

        .produtos-box {
            background: #fdf8f5;
            border-radius: 12px;
            padding: 14px 16px;
            border: 1px solid #f0e6dc;
        }

        .produtos-box-label {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .6px;
            color: #b09080;
            margin-bottom: 6px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .produtos-box-text {
            font-size: 13px;
            color: #4a3020;
            line-height: 1.6;
            margin: 0;
            white-space: pre-line;
        }

        /* ── TABELA PAGAMENTOS ───────────────────────────── */
        .pag-table-wrap {
            background: white;
            border-radius: 18px;
            border: 1px solid #f0e6dc;
            box-shadow: 0 2px 12px rgba(156,74,48,.05);
            overflow: hidden;
        }

        .pag-table {
            width: 100%;
            border-collapse: collapse;
        }

        .pag-table thead tr {
            background: #fdf8f4;
            border-bottom: 1px solid #f0e6dc;
        }

        .pag-table th {
            padding: 13px 18px;
            text-align: left;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .7px;
            color: #b09080;
        }

        .pag-table tbody tr {
            border-bottom: 1px solid #faf4ee;
            transition: background .15s;
        }

        .pag-table tbody tr:last-child { border-bottom: none; }
        .pag-table tbody tr:hover { background: #fdf8f5; }

        .pag-table td {
            padding: 14px 18px;
            font-size: 14px;
            color: #2a1a10;
        }

        .metodo-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #f6efe8;
            color: #7a5040;
            padding: 5px 11px;
            border-radius: 10px;
            font-size: 12px;
            font-weight: 600;
        }

        /* ── EMPTY STATE ─────────────────────────────────── */
        .cl-empty {
            background: white;
            border-radius: 18px;
            padding: 50px 40px;
            text-align: center;
            border: 1px solid #f0e6dc;
            box-shadow: 0 2px 12px rgba(156,74,48,.05);
        }

        .cl-empty i {
            font-size: 44px;
            color: #e8c4a0;
            display: block;
            margin-bottom: 12px;
        }

        .cl-empty-title {
            font-size: 16px;
            font-weight: 700;
            color: #2a1a10;
            margin-bottom: 6px;
        }

        .cl-empty-text {
            font-size: 13px;
            color: #b09080;
            margin: 0;
        }

        @media (max-width: 768px) {
            .resumo-grid { grid-template-columns: 1fr 1fr; }
            .saude-card { flex-direction: column; text-align: center; gap: 16px; }
            .saude-info { justify-content: center; gap: 16px; }
            .compra-right { flex-direction: column; align-items: flex-end; gap: 6px; }
            .pag-table-wrap { overflow-x: auto; }
        }

        @media (max-width: 480px) {
            .resumo-grid { grid-template-columns: 1fr; }
        }
    </style>
@endpush

@section('content')

    @php
        $totalComprado = $totalComprado ?? 0;
        $totalPago = $totalPago ?? 0;
        $saldoPendente = $saldoPendente ?? 0;
        $pctGeral = $totalComprado > 0
            ? min(100, round(($totalPago / $totalComprado) * 100))
            : 0;
        $totalCompras = $compras->count();
        $comprasPagas = $compras->where('status', 'pago')->count();
    @endphp

    {{-- ── CARDS DE RESUMO ─────────────────────────────── --}}
    <div class="resumo-grid">

        <div class="resumo-card card-azul">
            <div class="resumo-card-deco"></div>
            <div class="resumo-card-top">
                <span class="resumo-card-label">Total Comprado</span>
                <div class="resumo-card-icon"><i class="bi bi-bag-heart"></i></div>
            </div>
            <div class="resumo-card-value">R$ {{ number_format($totalComprado, 2, ',', '.') }}</div>
            <div class="resumo-card-sub">{{ $totalCompras }} compra(s) registrada(s)</div>
        </div>

        <div class="resumo-card card-verde">
            <div class="resumo-card-deco"></div>
            <div class="resumo-card-top">
                <span class="resumo-card-label">Total Pago</span>
                <div class="resumo-card-icon"><i class="bi bi-check-circle"></i></div>
            </div>
            <div class="resumo-card-value">R$ {{ number_format($totalPago, 2, ',', '.') }}</div>
            <div class="resumo-card-sub">{{ $comprasPagas }} compra(s) quitada(s)</div>
        </div>

        <div class="resumo-card card-amber">
            <div class="resumo-card-deco"></div>
            <div class="resumo-card-top">
                <span class="resumo-card-label">Saldo Pendente</span>
                <div class="resumo-card-icon"><i class="bi bi-hourglass-split"></i></div>
            </div>
            <div class="resumo-card-value">R$ {{ number_format($saldoPendente, 2, ',', '.') }}</div>
            <div class="resumo-card-sub">{{ $totalCompras - $comprasPagas }} compra(s) em aberto</div>
        </div>

        <div class="resumo-card card-roxo">
            <div class="resumo-card-deco"></div>
            <div class="resumo-card-top">
                <span class="resumo-card-label">Pagamentos</span>
                <div class="resumo-card-icon"><i class="bi bi-receipt"></i></div>
            </div>
            <div class="resumo-card-value">{{ $pagamentos->count() }}</div>
            <div class="resumo-card-sub">transação(ões) realizada(s)</div>
        </div>

    </div>

    {{-- ── BARRA DE SAÚDE FINANCEIRA ───────────────────── --}}
    <div class="saude-card">
        <div class="saude-icon"><i class="bi bi-graph-up-arrow"></i></div>
        <div class="saude-body">
            <div class="saude-title">Progresso geral dos pagamentos</div>
            <div class="saude-bar-track">
                <div class="saude-bar-fill" style="width: {{ $pctGeral }}%"></div>
            </div>
            <div class="saude-info">
                <span>Pago: R$ {{ number_format($totalPago, 2, ',', '.') }}</span>
                <span>Restante: R$ {{ number_format($saldoPendente, 2, ',', '.') }}</span>
            </div>
        </div>
        <div class="saude-pct">{{ $pctGeral }}%</div>
    </div>

    {{-- ── MINHAS COMPRAS ───────────────────────────────── --}}
    <div class="cl-section">

        <div class="cl-section-header">
            <div class="cl-section-icon"><i class="bi bi-cart-check"></i></div>
            <h2 class="cl-section-title">Minhas Compras</h2>
            <span class="cl-section-badge">{{ $totalCompras }} compra(s)</span>
        </div>

        @if($totalCompras > 0)
            <div class="compras-lista">
                @foreach($compras as $compra)
                        @php
                            $pago = $compra->pagamentos->sum('valor_pago');
                            $saldo = $compra->valor_total - $pago;
                            $pct = $compra->valor_total > 0
                                ? min(100, round(($pago / $compra->valor_total) * 100))
                                : 0;
                        @endphp

                        <div class="compra-card" id="compra-{{ $compra->id }}">

                            <div class="compra-card-head" onclick="toggleCompra('compra-{{ $compra->id }}')">

                                <div class="compra-num">#{{ $compra->id }}</div>

                                <div class="compra-info">
                                    <div class="compra-info-title">
                                        {{ $compra->descricao_produtos
                    ? \Illuminate\Support\Str::limit($compra->descricao_produtos, 48)
                    : 'Compra #' . $compra->id }}
                                    </div>
                                    <div class="compra-info-meta">
                                        <i class="bi bi-calendar3"></i>
                                        {{ \Carbon\Carbon::parse($compra->data_compra)->format('d/m/Y') }}
                                        &nbsp;·&nbsp;
                                        <i class="bi bi-grid-3x3-gap"></i>
                                        {{ $compra->qtd_parcelas }}x
                                    </div>
                                </div>

                                <div class="compra-right">
                                    <div>
                                        <div class="compra-valor-num">R$ {{ number_format($compra->valor_total, 2, ',', '.') }}</div>
                                        <div class="compra-valor-label">valor total</div>
                                    </div>

                                    @if($compra->status == 'pago')
                                        <span class="status-badge status-pago">Pago</span>
                                    @elseif($compra->status == 'parcial')
                                        <span class="status-badge status-parcial">Parcial</span>
                                    @else
                                        <span class="status-badge status-pendente">Pendente</span>
                                    @endif

                                    <i class="bi bi-chevron-down compra-chevron"></i>
                                </div>
                            </div>

                            <div class="compra-body">
                                <div class="compra-body-inner">

                                    <div class="progresso-wrap">
                                        <div class="progresso-top">
                                            <span class="progresso-label">
                                                <i class="bi bi-bar-chart-line"></i>
                                                Progresso do pagamento
                                            </span>
                                            <span class="progresso-pct">{{ $pct }}%</span>
                                        </div>
                                        <div class="progresso-track">
                                            <div class="progresso-fill {{ $pct >= 100 ? 'completo' : '' }}"
                                                 style="width: {{ $pct }}%"></div>
                                        </div>
                                        <div class="progresso-vals">
                                            <span>Pago: R$ {{ number_format($pago, 2, ',', '.') }}</span>
                                            <span>Restante: R$ {{ number_format($saldo, 2, ',', '.') }}</span>
                                        </div>
                                    </div>

                                    @if($compra->descricao_produtos)
                                        <div class="produtos-box">
                                            <div class="produtos-box-label">
                                                <i class="bi bi-box-seam"></i> Produtos
                                            </div>
                                            <p class="produtos-box-text">{{ $compra->descricao_produtos }}</p>
                                        </div>
                                    @endif

                                </div>
                            </div>

                        </div>
                @endforeach
            </div>
        @else
            <div class="cl-empty">
                <i class="bi bi-inbox"></i>
                <div class="cl-empty-title">Nenhuma compra registrada</div>
                <p class="cl-empty-text">Você não possui compras no momento.</p>
            </div>
        @endif

    </div>

    {{-- ── MEUS PAGAMENTOS ─────────────────────────────── --}}
    <div class="cl-section">

        <div class="cl-section-header">
            <div class="cl-section-icon"><i class="bi bi-credit-card"></i></div>
            <h2 class="cl-section-title">Meus Pagamentos</h2>
            <span class="cl-section-badge">{{ $pagamentos->count() }} pagamento(s)</span>
        </div>

        @if($pagamentos->count() > 0)
            <div class="pag-table-wrap">
                <table class="pag-table">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Compra</th>
                            <th>Valor</th>
                            <th>Método</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pagamentos as $pagamento)
                            <tr>
                                <td>
                                    <strong>{{ \Carbon\Carbon::parse($pagamento->data_pagamento)->format('d/m/Y') }}</strong>
                                </td>
                                <td style="color:#8a7060; font-size:13px;">
                                    #{{ $pagamento->compra->id }}
                                    &nbsp;·&nbsp;
                                    {{ \Carbon\Carbon::parse($pagamento->compra->data_compra)->format('d/m/Y') }}
                                </td>
                                <td>
                                    <strong style="color:#1a7a4a;">
                                        R$ {{ number_format($pagamento->valor_pago, 2, ',', '.') }}
                                    </strong>
                                </td>
                                <td>
                                    <span class="metodo-badge">
                                        @php
                                            $metodos = [
                                                'dinheiro' => ['bi-cash-coin', 'Dinheiro'],
                                                'transferencia' => ['bi-bank', 'Transferência'],
                                                'pix' => ['bi-qr-code', 'PIX'],
                                                'credito' => ['bi-credit-card', 'Crédito'],
                                                'debito' => ['bi-credit-card-2-back', 'Débito'],
                                                'boleto' => ['bi-upc-scan', 'Boleto'],
                                            ];
                                            $m = $metodos[$pagamento->metodo_pagamento] ?? ['bi-three-dots', $pagamento->metodo_pagamento];
                                        @endphp
                                        <i class="bi {{ $m[0] }}"></i> {{ $m[1] }}
                                    </span>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="cl-empty">
                <i class="bi bi-inbox"></i>
                <div class="cl-empty-title">Nenhum pagamento registrado</div>
                <p class="cl-empty-text">Seus pagamentos aparecerão aqui.</p>
            </div>
        @endif

    </div>

@endsection

@push('scripts')
    <script>
        function toggleCompra(id) {
            document.getElementById(id).classList.toggle('open');
        }
    </script>
@endpush