<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pré-visualização da Fatura - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .invoice-preview {
            max-width: 800px;
            margin: 0 auto;
            background: white;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
        }
        .invoice-header {
            background: linear-gradient(135deg, #004b8d, #00c476);
            color: white;
            padding: 30px;
        }
        .invoice-body {
            padding: 30px;
        }
        .payment-details {
            background-color: #f8fafc;
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
        }
        .btn-confirm {
            background: linear-gradient(135deg, #00c476, #00a566);
            color: white;
            transition: all 0.3s ease;
        }
        .btn-confirm:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 196, 118, 0.2);
        }
        .btn-change {
            background: white;
            color: #004b8d;
            border: 1px solid #004b8d;
            transition: all 0.3s ease;
        }
        .btn-change:hover {
            background-color: #f8fafc;
        }
        .alert-message {
            transition: opacity 0.5s ease-out;
        }
        
        /* Estilos do Modal de Confirmação */
        .confirmation-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0,0,0,0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background: white;
            padding: 2rem;
            border-radius: 0.5rem;
            max-width: 500px;
            width: 90%;
            box-shadow: 0 0 20px rgba(0,0,0,0.2);
            text-align: center;
            animation: modalFadeIn 0.3s ease-out;
        }
        @keyframes modalFadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .modal-actions {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 1.5rem;
        }
        .modal-btn {
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            display: inline-flex;
            align-items: center;
        }
        .modal-btn:hover {
            transform: translateY(-2px);
        }
        .btn-primary {
            background-color: #004b8d;
            color: white;
            border: 1px solid #004b8d;
        }
        .btn-primary:hover {
            background-color: #003366;
        }
        .btn-secondary {
            background-color: #f0f0f0;
            color: #333;
            border: 1px solid #ddd;
        }
        .btn-secondary:hover {
            background-color: #e0e0e0;
        }
        
        @media (max-width: 640px) {
            .invoice-header, .invoice-body {
                padding: 20px;
            }
            .modal-actions {
                flex-direction: column;
                gap: 0.75rem;
            }
            .modal-btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body class="bg-gray-50">
    @if(session('error'))
    <div class="fixed top-4 right-4 z-50 alert-message">
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4" role="alert">
            <div class="flex items-center">
                <i class="bi bi-exclamation-circle-fill mr-2"></i>
                <strong class="font-bold">Erro! </strong>
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        </div>
    </div>
    @endif

    <main class="container mx-auto px-4 py-12">
        <div class="invoice-preview">
            <!-- Cabeçalho da Fatura -->
            <div class="invoice-header">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                    <div class="mb-4 md:mb-0">
                        <img src="{{ asset('img/logomarca.png') }}" alt="Logo" class="h-12 mb-4" onerror="this.src='{{ asset('img/placeholder-logo.png') }}'">
                        <h2 class="text-2xl font-bold">{{ config('app.name') }}</h2>
                        <p class="mt-1 text-gray-100">NIF: {{ config('company.tax_id') ?? '5001132614' }}</p>
                    </div>
                    <div class="text-left md:text-right">
                        <h1 class="text-2xl md:text-3xl font-bold">Fatura #{{ 'ElpCod' . str_pad($service->id, 6, '0', STR_PAD_LEFT) }}</h1>
                        <p class="mt-2 text-gray-100">Data: {{ now()->format('d/m/Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Corpo da Fatura -->
            <div class="invoice-body">
                <!-- Seção do Cliente -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-[#004b8d] mb-2">Cliente:</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 bg-gray-50 p-4 rounded-lg">
                        <div>
                            <p class="font-medium">{{ $user->name }}</p>
                            <p>{{ $user->email }}</p>
                        </div>
                        <div>
                            @if($user->phone)
                                <p>Telefone: {{ $user->phone }}</p>
                            @else
                                <p class="text-gray-400">Telefone não informado</p>
                            @endif
                            @if($user->address)
                                <p>Endereço: {{ $user->address }}</p>
                            @else
                                <p class="text-gray-400">Endereço não informado</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Seção de Serviço -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold text-[#004b8d] mb-4">Detalhes do Serviço</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full border-collapse">
                            <thead>
                                <tr class="bg-gray-100">
                                    <th class="py-3 px-4 text-left border-b">Descrição</th>
                                    <th class="py-3 px-4 text-left border-b">Categoria</th>
                                    <th class="py-3 px-4 text-right border-b">Valor</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b">
                                    <td class="py-4 px-4">{{ $service->nome }}</td>
                                    <td class="py-4 px-4">{{ $service->category->name ?? 'Geral' }}</td>
                                    <td class="py-4 px-4 text-right">{{ number_format($service->preco, 2, ',', '.') }} MT</td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="py-4 px-4 text-right font-semibold">Total:</td>
                                    <td class="py-4 px-4 text-right font-bold text-[#004b8d]">{{ number_format($service->preco, 2, ',', '.') }} MT</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Seção de Pagamento -->
                <div class="payment-details">
                    <h3 class="text-lg font-semibold text-[#004b8d] mb-3">Método de Pagamento Selecionado</h3>
                    <div class="flex items-start">
                        <i class="bi 
                            @if($payment_method == 'Transferência por IBAN') bi-bank
                            @elseif($payment_method == 'Transferência por Nº de conta') bi-credit-card
                            @elseif($payment_method == 'Depósito') bi-cash-stack
                            @else bi-cash
                            @endif
                            text-2xl text-[#004b8d] mr-3"></i>
                        <div>
                            <h4 class="font-medium">{{ $payment_method }}</h4>
                            
                            @if($payment_method == 'Transferência por IBAN')
                                <p class="mt-2 text-sm">IBAN: {{ config('company.iban') ?? 'AO06 0055 0000 1234 5678 9012 3' }}</p>
                                <p class="text-sm">Banco: {{ config('company.bank_name') ?? 'Banco de Fomento Angola' }}</p>
                                <p class="mt-3 text-xs bg-yellow-50 text-yellow-700 p-2 rounded">
                                    <i class="bi bi-info-circle mr-1"></i>
                                    Use o número da fatura como referência
                                </p>
                            
                            @elseif($payment_method == 'Transferência por Nº de conta')
                                <p class="mt-2 text-sm">Conta: {{ config('company.account_number') ?? '1234567890' }}</p>
                                <p class="text-sm">NIB: {{ config('company.nib') ?? '0055 1234 1234567890 23' }}</p>
                                <p class="mt-3 text-xs bg-yellow-50 text-yellow-700 p-2 rounded">
                                    <i class="bi bi-info-circle mr-1"></i>
                                    Use o número da fatura como referência
                                </p>
                            
                            @elseif($payment_method == 'Depósito')
                                <p class="mt-2 text-sm">Banco: {{ config('company.bank_name') ?? 'Standard Bank' }}</p>
                                <p class="text-sm">Conta: {{ config('company.account_number') ?? '9876543210' }}</p>
                                <p class="mt-3 text-xs bg-yellow-50 text-yellow-700 p-2 rounded">
                                    <i class="bi bi-info-circle mr-1"></i>
                                    Apresente o comprovativo no balcão
                                </p>
                            
                            @elseif($payment_method == 'Cash')
                                <p class="mt-2 text-sm">Endereço: {{ config('company.address') ?? 'Rua Comercial, nº 123, Luanda' }}</p>
                                <p class="text-sm">Horário: {{ config('company.working_hours') ?? '8h-18h (Seg-Sex)' }}</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Ações -->
                <div class="mt-8 flex flex-col-reverse md:flex-row justify-between gap-4">
                    <a href="{{ route('payments.select', $service->id) }}" 
                       class="px-6 py-3 rounded-lg font-medium btn-change flex items-center justify-center">
                        <i class="bi bi-arrow-left mr-2"></i> Alterar Método
                    </a>
                    
                    <form id="confirmForm" action="{{ route('invoices.process', $service->id) }}" method="POST">
                        @csrf
                        <button type="submit" 
                                class="px-6 py-3 rounded-lg font-medium btn-confirm flex items-center justify-center w-full md:w-auto">
                            Confirmar e Gerar Fatura <i class="bi bi-check-circle ml-2"></i>
                        </button>
                    </form>
                </div>

                <!-- Selo de Segurança -->
                <div class="mt-6 pt-4 border-t border-gray-200 text-center">
                    <div class="flex items-center justify-center text-green-600">
                        <i class="bi bi-shield-lock-fill mr-2"></i>
                        <span class="text-sm">Pagamento seguro • Dados protegidos</span>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Modal de Confirmação -->
    <div id="confirmationModal" class="confirmation-modal">
        <div class="modal-content">
            <i class="bi bi-check-circle-fill text-5xl text-green-500 mb-4"></i>
            <h2 class="text-2xl font-bold mb-2">Finalizado com sucesso!</h2>
            
            <div id="emailStatusMessage" class="mb-4">
                @if(session('email_status.sent'))
                    <p class="text-green-600">
                        <i class="bi bi-check-circle-fill mr-1"></i>
                        Fatura enviada por email com sucesso!
                    </p>
                @elseif(session('email_status.message'))
                    <p class="text-yellow-600">
                        <i class="bi bi-exclamation-triangle-fill mr-1"></i>
                        {{ session('email_status.message') }}
                    </p>
                @endif
            </div>
            
            <p class="mb-4">Sua fatura foi gerada e está disponível para visualização.</p>
            
            <div class="modal-actions">
                <a href="{{ route('dashboard') }}" class="modal-btn btn-secondary">
                    <i class="bi bi-speedometer2 mr-2"></i> Ir para Dashboard
                </a>
                <a href="{{ session('invoice_view_url') }}" class="modal-btn btn-primary">
                    <i class="bi bi-file-earmark-text mr-2"></i> Ver Fatura
                </a>
            </div>
        </div>
    </div>

    <script>
        // Remove a mensagem de erro após 5 segundos
        setTimeout(() => {
            const alert = document.querySelector('.alert-message');
            if (alert) alert.style.opacity = '0';
        }, 5000);

        // Loading state no formulário
        document.getElementById('confirmForm')?.addEventListener('submit', function(e) {
            const btn = this.querySelector('button');
            btn.innerHTML = `<span class="flex items-center justify-center">
                <i class="bi bi-arrow-repeat animate-spin mr-2"></i> Processando...
            </span>`;
            btn.classList.add('opacity-75', 'cursor-not-allowed');
            btn.disabled = true;
            
            // Previne múltiplos cliques acidentais
            e.preventDefault();
            setTimeout(() => this.submit(), 500);
        });

        // Mostrar modal se houver sucesso no processamento
        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
                const modal = document.getElementById('confirmationModal');
                modal.style.display = 'flex';
                
                // Fechar modal ao clicar fora ou após 8 segundos
                modal.addEventListener('click', function(e) {
                    if (e.target === modal) {
                        modal.style.display = 'none';
                    }
                });
                
                // Fechar automaticamente após 8 segundos
                setTimeout(() => {
                    modal.style.display = 'none';
                }, 8000);
            @endif
        });
    </script>
</body>
</html>