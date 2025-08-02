<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seleção de Pagamento - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .payment-container {
            max-width: 800px;
            margin: 0 auto;
        }
        .payment-card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        .payment-header {
            background: linear-gradient(135deg, #004b8d, #00c476);
            color: white;
            padding: 25px;
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
            border: 2px solid #004b8d;
            background-color: #f0f7ff;
        }
        .btn-continue {
            background: linear-gradient(135deg, #00c476, #00a566);
            color: white;
        }
        .btn-back {
            background: white;
            color: #004b8d;
            border: 1px solid #004b8d;
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
        <div class="payment-container">
            <div class="payment-card">
                <!-- Cabeçalho -->
                <div class="payment-header">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-2xl font-bold">Selecione o Método de Pagamento</h1>
                            <p class="mt-2">Para o serviço: {{ $service->nome }}</p>
                        </div>
                        <img src="{{ asset('img/logomarca.png') }}" alt="Logo" class="h-12">
                    </div>
                </div>

                <!-- Corpo -->
                <div class="p-6">
                    <div class="mb-6">
                        <h2 class="text-lg font-semibold text-gray-700 mb-2">Detalhes do Serviço</h2>
                        <div class="bg-gray-50 p-4 rounded-lg">
                            <p class="font-medium">{{ $service->nome }}</p>
                            <p class="text-gray-600">{{ $service->descricao }}</p>
                            <p class="mt-2 text-lg font-bold text-[#004b8d]">
                                {{ number_format($service->preco, 2, ',', '.') }} MT
                            </p>
                        </div>
                    </div>

                    <form action="{{ route('payments.process', $service->id) }}" method="POST">
                        @csrf
                        
                        <h2 class="text-lg font-semibold text-gray-700 mb-4">Métodos Disponíveis</h2>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8">
                            @foreach($methods as $method)
                            <label class="payment-method">
                                <input type="radio" name="payment_method" value="{{ $method }}" required 
                                       class="hidden peer">
                                <div class="flex items-center p-3">
                                    <div class="mr-4">
                                        @if($method == 'Transferência por IBAN')
                                            <i class="bi bi-bank text-3xl text-[#004b8d]"></i>
                                        @elseif($method == 'Transferência por Nº de conta')
                                            <i class="bi bi-credit-card text-3xl text-[#004b8d]"></i>
                                        @elseif($method == 'Depósito')
                                            <i class="bi bi-cash-stack text-3xl text-[#004b8d]"></i>
                                        @else
                                            <i class="bi bi-cash text-3xl text-[#004b8d]"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <h3 class="font-medium">{{ $method }}</h3>
                                        @if($method == 'Transferência por IBAN')
                                            <p class="text-sm text-gray-600">Transferência bancária internacional</p>
                                        @elseif($method == 'Transferência por Nº de conta')
                                            <p class="text-sm text-gray-600">Transferência bancária nacional</p>
                                        @elseif($method == 'Depósito')
                                            <p class="text-sm text-gray-600">Depósito em agência bancária</p>
                                        @else
                                            <p class="text-sm text-gray-600">Pagamento em dinheiro</p>
                                        @endif
                                    </div>
                                </div>
                            </label>
                            @endforeach
                        </div>

                        <div class="flex flex-col-reverse md:flex-row justify-between gap-4">
                            <a href="{{ route('services.show', $service->id) }}" 
                               class="px-6 py-3 rounded-lg font-medium btn-back flex items-center justify-center">
                                <i class="bi bi-arrow-left mr-2"></i> Voltar
                            </a>
                            <button type="submit" 
                                    class="px-6 py-3 rounded-lg font-medium btn-continue flex items-center justify-center">
                                Continuar <i class="bi bi-arrow-right ml-2"></i>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Feedback visual ao selecionar método
        document.querySelectorAll('.payment-method input').forEach(el => {
            el.addEventListener('change', function() {
                document.querySelectorAll('.payment-method').forEach(box => {
                    box.classList.toggle('selected', box.contains(this));
                });
            });
        });

        // Remove a mensagem de erro após 5 segundos
        setTimeout(() => {
            const errorAlert = document.querySelector('[role="alert"]');
            if (errorAlert) {
                errorAlert.remove();
            }
        }, 5000);
    </script>
</body>
</html>