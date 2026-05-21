<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Relatório de Pagamentos — Lu Vendas</title>

    <style>
        :root {
            --rose: #c26b60;
            --rose-light: #e8a99f;
            --rose-pale: #fdf4f3;
            --rose-dark: #8c3f35;
            --rose-border: #f0ccc8;
            --ink: #1e1a19;
            --ink-mid: #5a504e;
            --ink-soft: #9b8e8b;
            --line: #ede5e3;
            --green: #3a7a4e;
            --green-pale: #edf7f1;
            --green-mid: #6aab7b;
            --gold: #b8956a;
            --gold-pale: #fdf6e8;
            --white: #ffffff;
            --surface: #faf8f7;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: DejaVu Sans, Arial, sans-serif;
            color: var(--ink);
            background: var(--white);
            font-size: 13px;
            line-height: 1.6;
        }

        /* ── PAGE ── */
        .page {
            max-width: 820px;
            margin: 0 auto;
            padding: 48px 52px 56px;
        }

        /* ── HEADER ── */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            padding-bottom: 24px;
            border-bottom: 1px solid var(--line);
            margin-bottom: 36px;
        }

        .brand-name {
            font-size: 30px;
            font-weight: 700;
            color: var(--rose-dark);
            letter-spacing: 0.5px;
            line-height: 1;
        }

        .brand-tagline {
            font-size: 11px;
            font-weight: 400;
            color: var(--ink-soft);
            letter-spacing: 1.6px;
            text-transform: uppercase;
            margin-top: 6px;
        }

        .meta-block {
            text-align: right;
        }

        .meta-label {
            font-size: 10px;
            font-weight: 700;
            color: var(--ink-soft);
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .meta-datetime {
            font-size: 15px;
            font-weight: 700;
            color: var(--ink);
            margin-top: 3px;
        }

        .meta-badge {
            display: inline-block;
            margin-top: 8px;
            padding: 3px 10px;
            background: var(--green-pale);
            border: 1px solid #b8dfc5;
            border-radius: 20px;
            font-size: 10px;
            font-weight: 700;
            color: var(--green);
            letter-spacing: 0.8px;
            text-transform: uppercase;
        }

        /* ── REPORT TITLE ── */
        .report-eyebrow {
            font-size: 10px;
            font-weight: 700;
            color: var(--green);
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .report-title {
            font-size: 20px;
            font-weight: 700;
            color: var(--ink);
            margin-bottom: 28px;
        }

        /* ── SUMMARY STRIP ── */
        .summary-strip {
            display: flex;
            gap: 14px;
            margin-bottom: 30px;
        }

        .stat {
            flex: 1;
            padding: 16px 18px;
            border-radius: 8px;
            border: 1px solid var(--line);
            background: var(--white);
            position: relative;
            overflow: hidden;
        }

        .stat::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
        }

        .stat-registros::after {
            background: var(--ink-soft);
        }

        .stat-total::after {
            background: var(--green-mid);
        }

        .stat-media::after {
            background: var(--gold);
        }

        .stat-label {
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.4px;
            text-transform: uppercase;
            color: var(--ink-soft);
            margin-bottom: 8px;
        }

        .stat-value {
            font-size: 20px;
            font-weight: 700;
            color: var(--ink);
            line-height: 1;
        }

        .stat-total .stat-value {
            color: var(--green);
        }

        .stat-media .stat-value {
            color: var(--gold);
        }

        /* ── TABLE ── */
        .table-wrap {
            border-radius: 8px;
            border: 1px solid var(--line);
            overflow: hidden;
            margin-bottom: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            background: var(--rose-dark);
            color: rgba(255, 255, 255, .85);
            padding: 12px 16px;
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1.6px;
            text-transform: uppercase;
            text-align: left;
            border: none;
        }

        thead th.col-r {
            text-align: right;
        }

        tbody td {
            padding: 12px 16px;
            border-bottom: 1px solid var(--line);
            font-size: 13px;
            color: var(--ink);
            vertical-align: middle;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        tbody tr:nth-child(even) td {
            background: var(--rose-pale);
        }

        .td-num {
            font-size: 11px;
            color: var(--ink-soft);
        }

        .td-cliente {
            font-weight: 600;
        }

        .td-valor {
            text-align: right;
            font-weight: 700;
            color: var(--green);
        }

        .td-metodo {
            text-align: center;
        }

        .td-date {
            text-align: right;
            font-size: 12px;
            color: var(--ink-soft);
        }

        /* method pill */
        .method-pill {
            display: inline-block;
            padding: 3px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
            background: var(--surface);
            border: 1px solid var(--line);
            color: var(--ink-mid);
            text-transform: capitalize;
        }

        /* ── TOTAL ROW ── */
        tfoot td {
            padding: 14px 16px;
            border: none;
            font-size: 13px;
            font-weight: 700;
        }

        tfoot .tf-bg {
            background: var(--ink);
            color: var(--white);
        }

        tfoot .tf-label {
            font-size: 10px;
            letter-spacing: 1.4px;
            text-transform: uppercase;
            color: rgba(255, 255, 255, .55);
            font-weight: 600;
        }

        tfoot .tf-value {
            text-align: right;
            font-size: 15px;
            color: #0eaf3c;
        }

        /* ── FOOTER ── */
        .divider {
            height: 1px;
            background: var(--line);
            margin: 36px 0 20px;
        }

        .footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer-brand {
            font-size: 14px;
            font-weight: 700;
            color: var(--rose-dark);
        }

        .footer-note {
            font-size: 10px;
            color: var(--ink-soft);
        }

        .footer-page {
            font-size: 10px;
            color: var(--ink-soft);
            font-weight: 700;
        }
    </style>

</head>

<body>
    <div class="page">

        {{-- HEADER --}}
        <div class="header">
            <div>
                <div class="brand-name">Lu Vendas</div>
                <div class="brand-tagline">Sistema de Gestão para Revendedoras</div>
            </div>
            <div class="meta-block">
                <div class="meta-label">Emitido em</div>
                <div class="meta-datetime">{{ now()->format('d/m/Y') }} </div>
                <div class="meta-badge">&#10003; Pagamentos</div>
            </div>
        </div>

        {{-- TITLE --}}
        <div class="report-eyebrow">Financeiro · Recebimentos</div>
        <div class="report-title">Relatório de Pagamentos Recebidos</div>

        {{-- SUMMARY STRIP --}}
        @php
            $total = $pagamentos->sum('valor_pago');
            $count = $pagamentos->count();
            $media = $count > 0 ? $total / $count : 0;
        @endphp

        <div class="summary-strip">
            <div class="stat stat-registros">
                <div class="stat-label">Registros</div>
                <div class="stat-value">{{ $count }}</div>
            </div>
            <div class="stat stat-total">
                <div class="stat-label">Total Recebido</div>
                <div class="stat-value">R$ {{ number_format($total, 2, ',', '.') }}</div>
            </div>
            <div class="stat stat-media">
                <div class="stat-label">Ticket Médio</div>
                <div class="stat-value">R$ {{ number_format($media, 2, ',', '.') }}</div>
            </div>
        </div>

        {{-- TABLE --}}
        <div class="table-wrap">
            <table>

                <thead>
                    <tr>
                        <th>#</th>
                        <th>Cliente</th>
                        <th class="col-r">Valor Pago</th>
                        <th style="text-align:center;">Método</th>
                        <th class="col-r">Data</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($pagamentos as $i => $pagamento)
                        <tr>
                            <td class="td-num">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</td>
                            <td class="td-cliente">{{ $pagamento->compra->cliente->nome }}</td>
                            <td class="td-valor">R$ {{ number_format($pagamento->valor_pago, 2, ',', '.') }}</td>
                            <td class="td-metodo">
                                <span class="method-pill">{{ $pagamento->metodo_pagamento }}</span>
                            </td>
                            <td class="td-date">{{ \Carbon\Carbon::parse($pagamento->data_pagamento)->format('d/m/Y') }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>

                <tfoot>
                    <tr>
                        <td colspan="2" class="tf-bg tf-label">Total Consolidado</td>
                        <td colspan="3" class="tf-bg tf-value">R$ {{ number_format($total, 2, ',', '.') }}</td>
                    </tr>
                </tfoot>

            </table>
        </div>

        {{-- FOOTER --}}
        <div class="divider"></div>
        <div class="footer">
            <div class="footer-brand">Lu Vendas</div>
            <div class="footer-note">Relatório gerado automaticamente · Documento confidencial</div>
        </div>

    </div>
</body>

</html>