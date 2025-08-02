<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Usuário | {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" 
          integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" 
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .bg-primary {
            background-color: #004b8d;
        }
        .bg-secondary {
            background-color: #00c476;
        }
        .text-primary {
            color: #004b8d;
        }
        .text-secondary {
            color: #00c476;
        }
        .border-primary {
            border-color: #004b8d;
        }
        .border-secondary {
            border-color: #00c476;
        }
        .hover\:bg-primary-dark:hover {
            background-color: #003a6d;
        }
        .hover\:bg-secondary-dark:hover {
            background-color: #00a366;
        }
        .search-input {
            transition: all 0.3s ease;
        }
        .search-input:focus {
            border-color: #00c476;
            box-shadow: 0 0 0 1px #00c476;
        }

    .notification-enter {
        opacity: 0;
        transform: translateX(100%);
    }
    .notification-enter-active {
        opacity: 1;
        transform: translateX(0);
        transition: all 0.3s ease;
    }
    .notification-exit {
        opacity: 1;
    }
    .notification-exit-active {
        opacity: 0;
        transition: opacity 0.5s ease;
    }

    </style>
</head>
<body class="font-sans bg-gray-50">
    <x-navbar />
    
    <main class="min-h-[calc(100vh-160px)] py-6 px-4 sm:px-6 lg:px-8">
@if(session('success'))
    <div class="fixed top-4 right-4 z-50">
        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 rounded-lg shadow-lg flex items-center justify-between min-w-80">
            <div class="flex items-center">
                <i class="fas fa-check-circle mr-3 text-green-500"></i>
                <span>{{ session('success') }}</span>
            </div>
            <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-green-700 hover:text-green-900">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
@endif

@if($errors->any())
    <div class="fixed top-4 right-4 z-50">
        <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 rounded-lg shadow-lg flex items-center justify-between min-w-80">
            <div class="flex items-center">
                <i class="fas fa-exclamation-circle mr-3 text-red-500"></i>
                <div>
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            </div>
            <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-red-700 hover:text-red-900">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>
@endif        <!-- Barra de Pesquisa e Filtros -->
        <div class="mb-6 bg-white rounded-lg shadow p-4">
            <form action="{{ route('pedidos.search') }}" method="GET">
                <div class="flex flex-col md:flex-row gap-4">
                    <div class="flex-grow relative">
                        <input type="text" name="search" placeholder="Pesquisar por número do pedido ou serviço..." 
                               class="w-full search-input pl-10 pr-4 py-2 border rounded-lg focus:outline-none"
                               value="{{ request('search') }}">
                        <div class="absolute left-3 top-2.5 text-gray-400">
                            <i class="bi bi-search"></i>
                        </div>
                    </div>
                    <div class="w-full md:w-auto">
                        <select name="status" class="w-full border rounded-lg px-4 py-2 focus:outline-none focus:border-secondary">
                            <option value="">Todos os status</option>
                            <option value="Pendente" {{ request('status') == 'Pendente' ? 'selected' : '' }}>Pendente</option>
                            <option value="Paga" {{ request('status') == 'Paga' ? 'selected' : '' }}>Paga</option>
                            <option value="Em processamento" {{ request('status') == 'Em processamento' ? 'selected' : '' }}>Em processamento</option>
                        </select>
                    </div>
                    <button type="submit" class="w-full md:w-auto bg-secondary hover:bg-secondary-dark text-white px-6 py-2 rounded-lg transition">
                        Filtrar
                    </button>
                    <a href="{{ route('pedidos.historico') }}" class="w-full md:w-auto border border-gray-300 text-gray-700 px-6 py-2 rounded-lg hover:bg-gray-50 transition text-center">
                        Limpar
                    </a>
                </div>
            </form>
        </div>

        <!-- Card de Pedidos Recentes -->
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-primary">Pedidos Recentes</h2>
                <a href="{{ route('pedidos.historico') }}" class="text-secondary text-sm font-medium hover:text-secondary-dark">Ver histórico</a>
            </div>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-primary uppercase tracking-wider">Nº Pedido</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-primary uppercase tracking-wider">Serviço</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-primary uppercase tracking-wider">Data</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-primary uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-primary uppercase tracking-wider">Ações</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($pedidos as $pedido)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">#{{ $pedido->code ?? 'N/A' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                {{ $pedido->service->nome ?? 'Serviço não especificado' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ optional($pedido->created_at)->format('d/m/Y') ?? 'Data não disponível' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $fatura = $pedido->fatura->first() ?? null;
                                @endphp
                                
@if($fatura)
    @if($fatura->status == 'paga')
        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
            Paga
        </span>
    @elseif($fatura->status == 'Em processamento')
        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
            Em processamento
        </span>
    @elseif($fatura->status == 'pendente')
        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
            Pendente
        </span>
    @else
        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
            Status desconhecido
        </span>
    @endif
@else
    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
        Sem fatura
    </span>
@endif
                            </td>
              
<td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
    <div class="flex space-x-2">
        <!-- Botão Ver Fatura -->
        <a href="{{ Storage::url($fatura->path) }}" 
           target="_blank"
           class="text-secondary hover:text-secondary-dark mr-2">
            <i class="bi bi-eye"></i>
        </a>        
        
        <!-- Botão Pagar (só aparece se status for Pendente) -->
        @if($fatura && $fatura->status == 'pendente')
           <button class="text-green-600 hover:text-green-800" 
                   onclick="openPaymentModal('{{ $fatura->id }}', '{{ number_format($fatura->total, 2, ',', '.') }}', '{{ $fatura->metodo_pagamento }}')">
               <i class="fas fa-credit-card"></i> Pagar
           </button>
        @endif

        <!-- Botão Comprovativo (só aparece se status for Em processamento) -->
        @if($fatura && $fatura->status == 'Em processamento' && $fatura->pagamento)
    <a href="{{ route('comprovante.show', $fatura->pagamento->id) }}" 
       class="text-blue-600 hover:text-blue-800 inline-flex items-center">
        <i class="fas fa-receipt mr-1"></i> Comprovativo
    </a>
@endif
    </div>
</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
                                Nenhum pedido encontrado
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                @if($pedidos->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $pedidos->links() }}
                </div>
                @endif
            </div>
        </div>

<div id="paymentModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
    <div class="bg-white rounded-lg p-6 w-full max-w-md">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold text-primary">Enviar Comprovante de Pagamento</h3>
            <button onclick="closePaymentModal()" class="text-gray-500 hover:text-gray-700">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>
        <form id="paymentForm" method="POST" action="{{ route('faturas.pagar') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="fatura_id" id="modalFaturaId">
            
            <!-- Valor automático -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-2">Valor Total:</label>
                <input type="text" id="modalFaturaValor" class="w-full border rounded-lg px-4 py-2 bg-gray-50" readonly>
            </div>
            
            <!-- Método de pagamento (automático) -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-2">Método de Pagamento:</label>
                <input type="text" id="modalMetodoPagamento" class="w-full border rounded-lg px-4 py-2 bg-gray-50" readonly>
                <input type="hidden" name="metodo_pagamento" id="modalMetodoPagamentoHidden">
            </div>
            
            <!-- Campo para comprovante (sempre visível) -->
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-medium mb-2">Comprovante:</label>
                <div class="mt-1 flex items-center">
                    <label for="comprovante" class="cursor-pointer bg-white py-2 px-3 border border-gray-300 rounded-lg shadow-sm text-sm leading-4 font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-secondary">
                        <i class="fas fa-cloud-upload-alt mr-2"></i>Selecionar arquivo
                    </label>
                    <span id="fileName" class="ml-2 text-sm text-gray-500">Nenhum arquivo selecionado</span>
                    <input type="file" name="comprovante" id="comprovante" class="sr-only" required accept=".pdf,.jpg,.jpeg,.png">
                </div>
                <p class="mt-1 text-xs text-gray-500">Formatos aceitos: PDF, JPG, PNG (Max: 5MB)</p>
            </div>
            
            <div class="flex justify-end gap-3 mt-6">
                <button type="button" onclick="closePaymentModal()" class="border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-50 transition">
                    Cancelar
                </button>
                <button type="submit" class="bg-secondary hover:bg-secondary-dark text-white px-6 py-2 rounded-lg transition">
                    Enviar Comprovante
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Função para abrir o modal com os dados da fatura
    function openPaymentModal(faturaId, valor, metodoPagamento) {
        document.getElementById('modalFaturaId').value = faturaId;
        document.getElementById('modalFaturaValor').value = 'R$ ' + valor;
        
        // Traduz o método de pagamento para exibição amigável
        const metodos = {
            'cartao': 'Cartão de Crédito',
            'pix': 'PIX',
            'boleto': 'Boleto Bancário',
            'transferencia': 'Transferência Bancária'
        };
        
        document.getElementById('modalMetodoPagamento').value = metodos[metodoPagamento] || metodoPagamento;
        document.getElementById('modalMetodoPagamentoHidden').value = metodoPagamento;
        
        // Resetar o campo de arquivo
        document.getElementById('comprovante').value = '';
        document.getElementById('fileName').textContent = 'Nenhum arquivo selecionado';
        
        document.getElementById('paymentModal').classList.remove('hidden');
    }
    
    // Fechar modal
    function closePaymentModal() {
        document.getElementById('paymentModal').classList.add('hidden');
    }
    
    // Mostrar nome do arquivo selecionado
    document.getElementById('comprovante').addEventListener('change', function(e) {
        const fileName = e.target.files[0] ? e.target.files[0].name : 'Nenhum arquivo selecionado';
        document.getElementById('fileName').textContent = fileName;
    });
    
    // Fechar modal ao clicar fora
    document.getElementById('paymentModal').addEventListener('click', function(e) {
        if(e.target === this) {
            closePaymentModal();
        }
    });

    // Auto-fechar notificações após 5 segundos
    document.addEventListener('DOMContentLoaded', function() {
        const notifications = document.querySelectorAll('[class*="fixed top-4 right-4"]');
        
        notifications.forEach(notification => {
            setTimeout(() => {
                notification.style.transition = 'opacity 0.5s ease';
                notification.style.opacity = '0';
                
                setTimeout(() => {
                    notification.remove();
                }, 500);
            }, 5000);
        });
    });
</script>
    </main>
    
    <x-deepbar />

</body>
</html>