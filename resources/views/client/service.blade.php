<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pré-visualização de Fatura - {{ config('app.name') }}</title>
    <link rel="stylesheet" href="/build/assets/app.css">
    <link rel="shortcut icon" href="/img/logomarca.png" type="image/x-icon">
    <script src="/build/assets/app2.js"></script>
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
        .payment-method {
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            cursor: pointer;
            transition: all 0.3s;
        }
        .payment-method:hover {
            border-color: #004b8d;
            background-color: #f8fafc;
        }
        .payment-method.selected {
            border: 2px solid #00c476;
            background-color: #f0fdf4;
        }
        .bank-details {
            background-color: #f8fafc;
            border-radius: 8px;
            padding: 15px;
            margin-top: 20px;
        }
        .btn-continue {
            background: linear-gradient(135deg, #00c476, #00a566);
            color: white;
        }
        .btn-download {
            background: linear-gradient(135deg, #004b8d, #003366);
            color: white;
        }
    </style>
</head>
<body class="bg-gray-50">
    @if(session('error'))
    <div class="fixed top-4 right-4 z-50">
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
        <div class="invoice-preview bg-white rounded-lg shadow-md p-8">
            <!-- Cabeçalho da Fatura -->
            <div class="invoice-header mb-8">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                    <div class="mb-4 md:mb-0">
                        <img src="{{ asset('img/logomarca.png') }}" alt="Logo" class="h-12 mb-4">
                        <h2 class="text-2xl font-bold">Elprime Solution</h2>
                        <p class="mt-1 text-gray-100">NIF: 5001132614</p>
                    </div>
                    <div class="text-left md:text-right">
                        <h1 class="text-2xl md:text-3xl font-bold">Fatura #{{ $service->code ?? ('ElpCod' . str_pad($service->id, 6, '0', STR_PAD_LEFT)) }}</h1>
                        <p class="mt-2 text-gray-100">Data: {{ now()->format('d/m/Y') }}</p>
                    </div>
                </div>
            </div>

            <!-- Corpo da Fatura -->
            <div class="invoice-body">
                <!-- Seção do Cliente -->
                <div class="mb-8 p-4 bg-gray-50 rounded-lg">
                    <h3 class="text-lg font-semibold text-[#004b8d] mb-2">Cliente:</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p class="font-medium">{{ Auth::user()->name }}</p>
                            <p>{{ Auth::user()->email }}</p>
                        </div>
                        <div>
                            @if(Auth::user()->phone)
                                <p>Telefone: {{ Auth::user()->phone }}</p>
                            @endif
                            @if(Auth::user()->address)
                                <p>Endereço: {{ Auth::user()->address }}</p>
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
                                    <th class="py-3 px-4 text-left border-b">Categoria</th>
                                    <th class="py-3 px-4 text-left border-b">Serviço</th>
                                    <th class="py-3 px-4 text-left border-b">Descrição</th>
                                    <th class="py-3 px-4 text-right border-b">Preço</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="border-b">
                                    <td class="py-4 px-4">{{ $service->category->name ?? 'Geral' }}</td>
                                    <td class="py-4 px-4">{{ $service->nome }}</td>
                                    <td class="py-4 px-4">{{ $service->descricao }}</td>
                                    <td class="py-4 px-4 text-right">{{ number_format($service->preco, 2, ',', '.') }} Kz</td>
                                </tr>
                                <!-- Total -->
                                <tr>
                                    <td colspan="3" class="py-4 px-4 text-right font-semibold">Total:</td>
                                    <td class="py-4 px-4 text-right font-bold text-[#004b8d]">{{ number_format($service->preco, 2, ',', '.') }} Kz</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Seção de Pagamento -->
                <div id="paymentSection" class="{{ !session('payment_method') ? 'hidden' : '' }}">
                    <div class="p-6 bg-gray-50 rounded-lg">
                        <h3 class="text-lg font-semibold text-[#004b8d] mb-4">Método de Pagamento</h3>
                        
                        @if(session('payment_method'))
                            <div class="bank-details space-y-3">
                                <h4 class="font-medium text-lg">
                                    <i class="bi bi-check-circle-fill text-green-500 mr-2"></i>
                                    Pagamento por: {{ session('payment_method') }}
                                </h4>
                                
                                @if(session('payment_method') == 'Transferência por IBAN')
                                    <div class="mt-4 space-y-2">
                                        <p><span class="font-medium">IBAN:</span> AO06 0055 0000 1234 5678 9012 3</p>
                                        <p><span class="font-medium">Banco:</span> Banco de Fomento Angola</p>
                                        <p><span class="font-medium">Titular:</span> {{ config('app.name') }}</p>
                                        <p class="mt-3 p-3 bg-yellow-50 text-yellow-700 rounded">
                                            <i class="bi bi-info-circle-fill mr-2"></i>
                                            Use o número da fatura como referência
                                        </p>
                                    </div>
                                
                                @elseif(session('payment_method') == 'Transferência por Nº de conta')
                                    <div class="mt-4 space-y-2">
                                        <p><span class="font-medium">Conta:</span> 1234567890</p>
                                        <p><span class="font-medium">NIB:</span> 0055 1234 1234567890 23</p>
                                        <p><span class="font-medium">Banco:</span> BAI</p>
                                        <p><span class="font-medium">Titular:</span> {{ config('app.name') }}</p>
                                        <p class="mt-3 p-3 bg-yellow-50 text-yellow-700 rounded">
                                            <i class="bi bi-info-circle-fill mr-2"></i>
                                            Use o número da fatura como referência
                                        </p>
                                    </div>
                                
                                @elseif(session('payment_method') == 'Depósito')
                                    <div class="mt-4 space-y-2">
                                        <p>Pode efetuar depósito em qualquer agência:</p>
                                        <p><span class="font-medium">Banco:</span> Standard Bank</p>
                                        <p><span class="font-medium">Conta:</span> 9876543210</p>
                                        <p><span class="font-medium">Titular:</span> {{ config('app.name') }}</p>
                                        <p class="mt-3 p-3 bg-yellow-50 text-yellow-700 rounded">
                                            <i class="bi bi-info-circle-fill mr-2"></i>
                                            Apresente o comprovativo no balcão
                                        </p>
                                    </div>
                                
                                @elseif(session('payment_method') == 'Cash')
                                    <div class="mt-4 space-y-2">
                                        <p>Dirija-se a nossa loja física para efetuar o pagamento:</p>
                                        <p><span class="font-medium">Endereço:</span> Rua Comercial, nº 123, Luanda</p>
                                        <p><span class="font-medium">Horário:</span> 8h-18h (Seg-Sex)</p>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Seção de Métodos de Pagamento -->
                <div id="methodsSection" class="{{ session('payment_method') ? 'hidden' : '' }}">
                    <div class="p-6 bg-gray-50 rounded-lg">
                        <h3 class="text-lg font-semibold text-[#004b8d] mb-6">Selecione o Método de Pagamento</h3>
                        
                        <form id="paymentForm" action="{{ route('payments.process', $service->id) }}" method="POST">
                            @csrf
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <label class="payment-method">
                                    <input type="radio" name="payment_method" value="Transferência por IBAN" required class="hidden peer">
                                    <div class="flex items-center p-4 border-2 border-transparent peer-checked:border-blue-500 peer-checked:bg-blue-50 rounded-lg transition-all">
                                        <i class="bi bi-bank text-2xl text-[#004b8d] mr-3"></i>
                                        <div>
                                            <h4 class="font-medium">Transferência por IBAN</h4>
                                            <p class="text-sm text-gray-600">Transferência bancária internacional</p>
                                        </div>
                                    </div>
                                </label>
                                
                                <label class="payment-method">
                                    <input type="radio" name="payment_method" value="Transferência por Nº de conta" class="hidden peer">
                                    <div class="flex items-center p-4 border-2 border-transparent peer-checked:border-blue-500 peer-checked:bg-blue-50 rounded-lg transition-all">
                                        <i class="bi bi-credit-card text-2xl text-[#004b8d] mr-3"></i>
                                        <div>
                                            <h4 class="font-medium">Transferência por Nº de conta</h4>
                                            <p class="text-sm text-gray-600">Transferência bancária nacional</p>
                                        </div>
                                    </div>
                                </label>
                                
                                <label class="payment-method">
                                    <input type="radio" name="payment_method" value="Depósito" class="hidden peer">
                                    <div class="flex items-center p-4 border-2 border-transparent peer-checked:border-blue-500 peer-checked:bg-blue-50 rounded-lg transition-all">
                                        <i class="bi bi-cash-stack text-2xl text-[#004b8d] mr-3"></i>
                                        <div>
                                            <h4 class="font-medium">Depósito</h4>
                                            <p class="text-sm text-gray-600">Depósito em agência bancária</p>
                                        </div>
                                    </div>
                                </label>
                                
                                <label class="payment-method">
                                    <input type="radio" name="payment_method" value="Cash" class="hidden peer">
                                    <div class="flex items-center p-4 border-2 border-transparent peer-checked:border-blue-500 peer-checked:bg-blue-50 rounded-lg transition-all">
                                        <i class="bi bi-cash text-2xl text-[#004b8d] mr-3"></i>
                                        <div>
                                            <h4 class="font-medium">Cash</h4>
                                            <p class="text-sm text-gray-600">Pagamento em dinheiro</p>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            
                            <div class="mt-8 flex justify-end">
                                <button type="submit" class="px-6 py-3 bg-[#004b8d] text-white rounded-lg font-medium hover:bg-[#003366] transition-colors">
                                    Continuar <i class="bi bi-arrow-right ml-2"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Seção Finalizar -->
                @if(session('payment_method'))
                    <div class="mt-8 flex flex-col-reverse md:flex-row justify-between gap-4">
                        <a href="{{ route('payments.select', $service->id) }}" class="px-6 py-3 rounded-lg font-medium border border-gray-300 text-center hover:bg-gray-50 transition-colors">
                            <i class="bi bi-arrow-left mr-2"></i> Alterar Método
                        </a>
                        
                        <form id="finalizeForm" action="{{ route('invoices.process', $service->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full md:w-auto px-6 py-3 bg-green-600 text-white rounded-lg font-medium hover:bg-green-700 transition-colors flex items-center justify-center">
                                Confirmar Pedido <i class="bi bi-check-circle ml-2"></i>
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </main>

    <!-- Modal de Confirmação -->
    @if(session('success'))
        <div id="successModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white rounded-lg p-8 max-w-md">
                <div class="text-center">
                    <i class="bi bi-check-circle-fill text-5xl text-green-500 mb-4"></i>
                    <h3 class="text-2xl font-bold text-gray-800 mb-2">{{ session('success') }}</h3>
                    
                    @if(session('email_status'))
                        <div class="mb-4 p-3 rounded-lg {{ session('email_status.sent') ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700' }}">
                            <i class="bi {{ session('email_status.sent') ? 'bi-check-circle-fill' : 'bi-exclamation-triangle-fill' }} mr-2"></i>
                            {{ session('email_status.message') }}
                        </div>
                    @endif
                    
                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        <a href="{{ route('invoices.download', session('invoice_id')) }}" class="px-4 py-2 bg-[#004b8d] text-white rounded-lg font-medium hover:bg-[#003366] transition-colors">
                            <i class="bi bi-download mr-2"></i> Baixar Fatura
                        </a>
                        <a href="{{ route('dashboard') }}" class="px-4 py-2 rounded-lg font-medium border border-gray-300 hover:bg-gray-50 transition-colors">
                            Ir para Dashboard
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <script>
            // Fechar modal ao clicar fora
            document.getElementById('successModal')?.addEventListener('click', function(e) {
                if (e.target === this) {
                    this.remove();
                }
            });
        </script>
    @endif

    <script>
        // Feedback visual ao selecionar método
        document.querySelectorAll('.payment-method input')?.forEach(el => {
            el.addEventListener('change', function() {
                document.querySelectorAll('.payment-method > div')?.forEach(box => {
                    box.classList.toggle('ring-2', box.parentElement.contains(this));
                    box.classList.toggle('ring-blue-500', box.parentElement.contains(this));
                });
            });
        });

        // Loading state no formulário final
        document.getElementById('finalizeForm')?.addEventListener('submit', function() {
            const btn = this.querySelector('button');
            btn.innerHTML = `<i class="bi bi-arrow-repeat animate-spin mr-2"></i> Processando...`;
            btn.disabled = true;
        });
    </script>
</body>
</html>