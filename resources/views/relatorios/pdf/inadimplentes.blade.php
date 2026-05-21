<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Clientes Inadimplentes — Lu Vendas</title>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=DM+Sans:wght@300;400;500;600&display=swap');

        :root {
            --rose: #c26b60;
            --rose-light: #e8a99f;
            --rose-pale: #fdf4f3;
            --rose-dark: #8c3f35;
            --ink: #1e1a19;
            --ink-mid: #5a504e;
            --ink-soft: #9b8e8b;
            --line: #ede5e3;
            --white: #ffffff;
            --gold: #b8956a;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'DM Sans', Arial, sans-serif;
            font-weight: 400;
            color: var(--ink);
            background: var(--white);
            font-size: 13px;
            line-height: 1.6;
        }

        /* ── PAGE WRAPPER ── */
        .page {
            max-width: 800px;
            margin: 0 auto;
            padding: 48px 52px 56px;
            background: var(--white);
        }

        /* ── HEADER ── */
        .header {
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            padding-bottom: 28px;
            border-bottom: 1px solid var(--line);
            margin-bottom: 36px;
        }

        .brand-block {}

        .brand-name {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 32px;
            font-weight: 700;
            color: var(--rose-dark);
            letter-spacing: 0.5px;
            line-height: 1;
        }

        .brand-tagline {
            font-size: 11px;
            font-weight: 300;
            color: var(--ink-soft);
            letter-spacing: 1.8px;
            text-transform: uppercase;
            margin-top: 6px;
        }

        .meta-block {
            text-align: right;
        }

        .meta-label {
            font-size: 10px;
            font-weight: 500;
            color: var(--ink-soft);
            letter-spacing: 1.5px;
            text-transform: uppercase;
        }

        .meta-date {
            font-size: 15px;
            font-weight: 600;
            color: var(--ink);
            margin-top: 3px;
        }

        .meta-badge {
            display: inline-block;
            margin-top: 8px;
            padding: 3px 10px;
            background: var(--rose-pale);
            border: 1px solid var(--rose-light);
            border-radius: 20px;
            font-size: 10px;
            font-weight: 500;
            color: var(--rose-dark);
            letter-spacing: 0.8px;
            text-transform: uppercase;
        }

        /* ── REPORT TITLE ── */
        .report-title-wrap {
            margin-bottom: 28px;
        }

        .report-eyebrow {
            font-size: 10px;
            font-weight: 500;
            color: var(--rose);
            letter-spacing: 2px;
            text-transform: uppercase;
            margin-bottom: 6px;
        }

        .report-title {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 22px;
            font-weight: 700;
            color: var(--ink);
        }

        /* ── SUMMARY CARDS ── */
        .summary-row {
            display: flex;
            gap: 16px;
            margin-bottom: 32px;
        }

        .card {
            flex: 1;
            padding: 16px 20px;
            border-radius: 8px;
            border: 1px solid var(--line);
            background: var(--white);
            position: relative;
            overflow: hidden;
        }

        .card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 4px;
            height: 100%;
            background: var(--rose);
        }

        .card.card-total::before {
            background: var(--ink-soft);
        }

        .card.card-pago::before {
            background: #6aab7b;
        }

        .card.card-saldo::before {
            background: var(--rose);
        }

        .card.card-clientes::before {
            background: var(--gold);
        }

        .card-label {
            font-size: 10px;
            font-weight: 500;
            color: var(--ink-soft);
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-bottom: 6px;
        }

        .card-value {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 20px;
            font-weight: 700;
            color: var(--ink);
            line-height: 1.1;
        }

        .card.card-saldo .card-value {
            color: var(--rose-dark);
        }

        .card.card-pago .card-value {
            color: #3a7a4e;
        }

        /* ── TABLE ── */
        .table-wrap {
            border-radius: 8px;
            border: 1px solid var(--line);
            overflow: hidden;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        /* head */
        thead tr {
            background: var(--rose-dark);
        }

        thead th {
            padding: 13px 16px;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 1.6px;
            text-transform: uppercase;
            color: rgba(255, 255, 255, 0.88);
            text-align: left;
        }

        thead th:not(:first-child) {
            text-align: right;
        }

        /* body */
        tbody td {
            padding: 12px 16px;
            border-bottom: 1px solid var(--line);
            font-size: 13px;
            color: var(--ink);
        }

        tbody td:not(:first-child) {
            text-align: right;
        }

        tbody tr:last-child td {
            border-bottom: none;
        }

        tbody tr:nth-child(even) td {
            background: var(--rose-pale);
        }

        /* name */
        .td-name {
            font-weight: 500;
            color: var(--ink);
        }

        .td-total {
            color: var(--ink-mid);
        }

        .td-pago {
            color: #3a7a4e;
            font-weight: 500;
        }

        .td-saldo {
            font-weight: 700;
            color: var(--rose-dark);
        }

        /* pill for overdue */
        .pill-saldo {
            display: inline-block;
            padding: 2px 10px;
            border-radius: 20px;
            background: #fceaea;
            border: 1px solid #f0c0bb;
            color: var(--rose-dark);
            font-weight: 700;
            font-size: 12px;
        }

        /* ── TOTALS ROW ── */
        tfoot tr {
            background: var(--ink);
        }

        tfoot td {
            padding: 13px 16px;
            font-size: 13px;
            font-weight: 600;
            color: var(--white);
            border: none;
        }

        tfoot td:not(:first-child) {
            text-align: right;
        }

        tfoot .tf-pago {
            color: #03a932;
        }

        tfoot .tf-saldo {
            color: #d21a09;
        }

        /* ── DIVIDER ── */
        .divider {
            height: 1px;
            background: var(--line);
            margin: 36px 0;
        }

        /* ── FOOTER ── */
        .footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer-brand {
            font-family: 'Playfair Display', Georgia, serif;
            font-size: 14px;
            color: var(--rose-dark);
            font-weight: 700;
        }

        .footer-note {
            font-size: 10px;
            color: var(--ink-soft);
            letter-spacing: 0.5px;
        }

        .footer-page {
            font-size: 10px;
            color: var(--ink-soft);
            font-weight: 500;
        }

        /* ── ORNAMENT LINE ── */
        .ornament {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 32px;
        }

        .ornament-line {
            flex: 1;
            height: 1px;
            background: var(--line);
        }

        .ornament-dot {
            width: 5px;
            height: 5px;
            border-radius: 50%;
            background: var(--rose-light);
        }
    </style>
</head>

<body>
    <div class="page">

        <!-- HEADER -->
        <div class="header">
            <div class="brand-block">
                <div class="brand-name">Lu Vendas</div>
                <div class="brand-tagline">Sistema de Gestão para Revendedoras</div>
            </div>
            <div class="meta-block">
                <div class="meta-label">Data de emissão</div>
                <div class="meta-date">{{ now()->format('d/m/Y') }}</div>
                <div class="meta-badge">Uso Interno</div>
            </div>
        </div>

        <!-- REPORT TITLE -->
        <div class="report-title-wrap">
            <div class="report-eyebrow">Financeiro · Inadimplência</div>
            <div class="report-title">Relatório de Clientes Inadimplentes</div>
        </div>

        <!-- SUMMARY CARDS -->
        @php
            $totalGeral = $compras->sum('valor_total');
            $totalPagoGeral = $compras->sum(fn($c) => $c->pagamentos->sum('valor_pago'));
            $totalSaldo = $totalGeral - $totalPagoGeral;
            $qtdClientes = $compras->count();
        @endphp

        <div class="summary-row">
            <div class="card card-clientes">
                <div class="card-label">Clientes</div>
                <div class="card-value">{{ $qtdClientes }}</div>
            </div>
            <div class="card card-total">
                <div class="card-label">Total Emitido</div>
                <div class="card-value">R$ {{ number_format($totalGeral, 2, ',', '.') }}</div>
            </div>
            <div class="card card-pago">
                <div class="card-label">Total Recebido</div>
                <div class="card-value">R$ {{ number_format($totalPagoGeral, 2, ',', '.') }}</div>
            </div>
            <div class="card card-saldo">
                <div class="card-label">Saldo em Aberto</div>
                <div class="card-value">R$ {{ number_format($totalSaldo, 2, ',', '.') }}</div>
            </div>
        </div>

        <!-- TABLE -->
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Cliente</th>
                        <th>Valor Total</th>
                        <th>Total Pago</th>
                        <th>Saldo em Aberto</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($compras as $i => $compra)
                        @php
                            $totalPago = $compra->pagamentos->sum('valor_pago');
                            $saldo = $compra->valor_total - $totalPago;
                        @endphp
                        <tr>
                            <td style="color:var(--ink-soft); font-size:11px;">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}
                            </td>
                            <td class="td-name">{{ $compra->cliente->nome }}</td>
                            <td class="td-total">R$ {{ number_format($compra->valor_total, 2, ',', '.') }}</td>
                            <td class="td-pago">R$ {{ number_format($totalPago, 2, ',', '.') }}</td>
                            <td><span class="pill-saldo">R$ {{ number_format($saldo, 2, ',', '.') }}</span></td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2"
                            style="font-size:10px; letter-spacing:1.2px; text-transform:uppercase; color:rgba(255,255,255,0.5);">
                            Total Consolidado</td>
                        <td>R$ {{ number_format($totalGeral, 2, ',', '.') }}</td>
                        <td class="tf-pago">R$ {{ number_format($totalPagoGeral, 2, ',', '.') }}</td>
                        <td class="tf-saldo">R$ {{ number_format($totalSaldo, 2, ',', '.') }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        <!-- FOOTER -->
        <div class="divider"></div>

        <div class="footer">
            <div class="footer-brand">Lu Vendas</div>
            <div class="footer-note">Relatório gerado automaticamente · Documento confidencial</div>
        </div>
    </div>
</body>

</html>