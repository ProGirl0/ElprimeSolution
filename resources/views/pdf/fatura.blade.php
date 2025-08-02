<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Fatura {{ $pedido->code }}</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        .header { margin-bottom: 30px; }
        .logo { height: 60px; }
        .invoice-info { float: right; text-align: right; }
        .customer-info { margin-bottom: 30px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 30px; }
        th { background-color: #f8f9fa; text-align: left; padding: 10px; }
        td { padding: 10px; border-bottom: 1px solid #eee; }
        .total { font-weight: bold; font-size: 1.2em; }
        .footer { margin-top: 50px; font-size: 0.8em; text-align: center; }
        .payment-method { margin-top: 30px; }
    </style>
</head>
<body>
    <div class="header">
        <img src="{{ storage_path('app/public/logo.png') }}" class="logo" alt="Logo">
        <div class="invoice-info">
            <h1>Fatura #{{ $pedido->code }}</h1>
            <p>Data: {{ now()->format('d/m/Y') }}</p>
        </div>
    </div>

    <div class="customer-info">
        <h3>Empresa</h3>
        <p>{{ config('app.name') }}</p>
        <p>NIF: 123456789</p>
        <br>
        <h3>Cliente</h3>
        <p>{{ $user->name }}</p>
        <p>{{ $user->email }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Serviço</th>
                <th>Descrição</th>
                <th>Preço</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $service->nome }}</td>
                <td>{{ $service->descricao }}</td>
                <td>{{ number_format($service->preco, 2, ',', '.') }} MT</td>
            </tr>
        </tbody>
    </table>

    <div class="payment-method">
        <h3>Método de Pagamento</h3>
        <p>{{ $payment_method }}</p>
        
        @if($payment_method == 'Transferência por IBAN')
            <p>IBAN: AO06 0055 0000 1234 5678 9012 3</p>
            <p>Banco: Banco de Fomento Angola</p>
        @elseif($payment_method == 'Transferência por Nº de conta')
            <p>Conta: 1234567890</p>
            <p>NIB: 0055 1234 1234567890 23</p>
            <p>Banco: BAI</p>
        @elseif($payment_method == 'Depósito')
            <p>Banco: Standard Bank</p>
            <p>Conta: 9876543210</p>
        @endif
    </div>

    <div class="total">
        <p>Total: {{ number_format($service->preco, 2, ',', '.') }} MT</p>
    </div>

    <div class="footer">
        <p>{{ config('app.name') }} - Todos os direitos reservados</p>
        <p>Qualquer dúvida, contacte-nos: suporte@empresa.com</p>
    </div>
</body>
</html>