<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fatura #{{ $pedido->code ?? '' }}</title>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; }
        .header { background-color: #004b8d; color: white; padding: 20px; text-align: center; }
        .content { padding: 20px; }
        .footer { margin-top: 20px; padding-top: 20px; border-top: 1px solid #eee; text-align: center; font-size: 0.9em; }
        .alert { padding: 10px; background-color: #f8f9fa; border-radius: 5px; margin: 15px 0; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>{{ config('app.name') }}</h2>
            <h3>Fatura #{{ $pedido->code ?? 'N/A' }}</h3>
        </div>
        
        <div class="content">
            <p>Olá, {{ $user->name ?? 'Cliente' }},</p>
            
            <p>Sua fatura foi gerada com sucesso:</p>
            
            <div class="alert">
                <p><strong>Serviço:</strong> {{ $service->nome ?? 'N/A' }}</p>
                <p><strong>Valor:</strong> {{ number_format($fatura->total ?? 0, 2, ',', '.') }} MT</p>
                <p><strong>Método de Pagamento:</strong> {{ $payment_method ?? 'N/A' }}</p>
            </div>
            
            <p>A fatura está anexa a este e-mail em formato PDF.</p>
        </div>
        
        <div class="footer">
            <p>Caso tenha alguma dúvida, entre em contato conosco.</p>
            <p>{{ config('app.name') }} &copy; {{ date('Y') }}</p>
        </div>
    </div>
</body>
</html>