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
        .servicos-ticker-container {
        overflow-x: hidden;
        position: relative;
        }
        
        .servicos-track {
            display: inline-block;
            animation: scroll 150s linear infinite;
        }
        
        @keyframes scroll {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        
        .servicos-ticker-container:hover .servicos-track {
            animation-play-state: paused;
        }
        
        .servico-card {
            flex: 0 0 auto;
        }
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
    </style>
</head>
<body class="font-sans bg-gray-50">
    <x-navbar />
    
    <main class="min-h-[calc(100vh-160px)] py-6 px-4 sm:px-6 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <!-- Cabeçalho -->
            <div class="mb-8">
                <h1 class="text-3xl font-bold text-primary">Bem-vindo(a), {{ Auth::user()->name }}</h1>
                <p class="mt-2 text-gray-600">Aqui você pode gerenciar todas as suas atividades e informações</p>
            </div>

            <!-- Grid Principal -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Coluna 1: Resumo e Notificações -->
                <div class="lg:col-span-1 space-y-6">
                    

<!-- Card de Notificações -->
<div class="bg-white rounded-lg shadow p-6">
    <!-- Cabeçalho -->
    <div class="flex items-center justify-between mb-4">
        <div class="flex items-center">
            <i class="bi bi-bell-fill text-primary mr-2"></i>
            <h2 class="text-lg font-semibold text-primary">Notificações</h2>
        </div>
        <span class="bg-secondary text-white text-xs px-2 py-1 rounded-full">
            {{ $notificacoes->count() }} {{ $notificacoes->count() == 1 ? 'nova' : 'novas' }}
        </span>
    </div>
    
    <!-- Lista de Notificações -->
    <div class="space-y-3 max-h-60 overflow-y-auto pr-2">
        @forelse($notificacoes as $notificacao)
            <div class="flex items-start gap-3 p-3 rounded-lg hover:bg-gray-50 transition cursor-pointer border border-gray-100">
                <!-- Ícone com cor dinâmica -->
                <div class="p-2 rounded-full 
                    @if($notificacao->tipo == 'Validação de comprovativo') bg-green-100
                    @elseif($notificacao->tipo == 'Invalidação de comprovativo') bg-red-100
                    @else bg-blue-100 @endif">
                    <i class="bi 
                        @if($notificacao->tipo == 'Validação de comprovativo') bi-check-circle-fill text-green-600
                        @elseif($notificacao->tipo == 'Invalidação de comprovativo') bi-x-circle-fill text-red-600
                        @else bi-info-circle-fill text-blue-600 @endif
                        text-lg"></i>
                </div>
                
                <!-- Conteúdo da notificação -->
                <div class="flex-1">
                    <p class="text-sm font-medium text-gray-800">{{ $notificacao->titulo }}</p>
                    <p class="text-xs text-gray-500 mb-1">{{ $notificacao->descricao }}</p>
                    <span class="text-xs 
                        @if($notificacao->tipo == 'Validação de comprovativo') text-green-600
                        @elseif($notificacao->tipo == 'Invalidação de comprovativo') text-red-600
                        @else text-blue-600 @endif">
                        {{ $notificacao->created_at->diffForHumans() }}
                    </span>
                </div>
                
                <!-- Indicador de não lida -->
                @unless($notificacao->lida)
                <span class="w-2 h-2 
                    @if($notificacao->tipo == 'Validação de comprovativo') bg-green-600
                    @elseif($notificacao->tipo == 'Invalidação de comprovativo') bg-red-600
                    @else bg-blue-600 @endif
                    rounded-full mt-1.5"></span>
                @endunless
            </div>
        @empty
            <!-- Estado quando não há notificações -->
            <div class="flex flex-col items-center justify-center p-6 text-center">
                <div class="bg-yellow-100 p-3 rounded-full mb-3">
                    <i class="bi bi-exclamation-triangle-fill text-yellow-600 text-xl"></i>
                </div>
                <p class="text-sm font-medium text-gray-800">Nenhuma notificação encontrada</p>
                <p class="text-xs text-gray-500">Você não tem nenhuma notificação no momento</p>
            </div>
        @endforelse
    </div>
    
    <!-- Rodapé -->
    <button class="mt-4 w-full border border-primary text-primary hover:bg-primary hover:text-white py-2 px-4 rounded transition duration-200 flex items-center justify-center">
        <i class="bi bi-list-ul mr-2"></i> Ver Todas as Notificações
    </button>
</div>
<!-- Card de Resumo -->
<div class="bg-white rounded-lg shadow p-6">
    <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg font-semibold text-primary">Pagamentos</h2>
        <span class="bg-secondary text-white text-xs px-2 py-1 rounded-full">Ativo</span>
    </div>
    
    <!-- Últimos Pagamentos -->
  <div class="space-y-3">
    <!-- Seção de Pagamentos -->
@foreach($pagamentos as $pagamento)
    <div class="flex items-center justify-between p-3 hover:bg-gray-50 rounded-lg border">
        <div class="flex items-center">
            @if($pagamento['path'])
                @if($pagamento['path']['tipo'] === 'pdf')
                    <i class="bi bi-file-earmark-pdf text-red-500 text-xl mr-3"></i>
                @else
                    <img src="{{ $pagamento['path']['url'] }}" 
                         class="w-10 h-10 object-cover rounded mr-3"
                         alt="Comprovante">
                @endif
            @else
                <i class="bi bi-file-earmark-excel text-gray-400 text-xl mr-3"></i>
            @endif
            
            <div>
                <p class="text-sm font-medium">Fatura #{{ $pagamento['id_fatura'] }}</p>
                <p class="text-xs text-gray-500">{{ $pagamento['data'] }}</p>
            </div>
        </div>
        
        <span class="px-2 py-1 text-xs rounded-full 
            @if($pagamento['status'] == 'aprovado') bg-green-100 text-green-800
            @elseif($pagamento['status'] == 'pendente') bg-yellow-100 text-yellow-800
            @else bg-gray-100 text-gray-800 @endif">
            {{ ucfirst($pagamento['status']) }}
        </span>
    </div>
@endforeach
</div>    
    
    <button class="mt-4 w-full bg-primary hover:bg-primary-dark text-white py-2 px-4 rounded transition duration-200">
        Ver Detalhes
    </button>
</div>
</div>
                <!-- Coluna 2: Feed e Novidades -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Card de Novidades -->
                    <div class="bg-white rounded-lg shadow p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-lg font-semibold text-primary">Novidades</h2>
                            <button class="text-secondary text-sm font-medium">Ver todas</button>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition duration-200">
                                <div class="bg-primary bg-opacity-10 p-3 rounded-lg inline-block mb-3">
                                    <i class="bi bi-megaphone text-primary text-xl"></i>
                                </div>
                                <h3 class="font-medium text-primary">Novo serviço disponível</h3>
                                <p class="text-sm text-gray-600 mt-1">Conheça nosso novo pacote de soluções empresariais.</p>
                                <p class="text-xs text-gray-400 mt-2">Publicado em: 15/06/2023</p>
                            </div>
                            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition duration-200">
                                <div class="bg-secondary bg-opacity-10 p-3 rounded-lg inline-block mb-3">
                                    <i class="bi bi-calendar-check text-secondary text-xl"></i>
                                </div>
                                <h3 class="font-medium text-primary">Atualização do sistema</h3>
                                <p class="text-sm text-gray-600 mt-1">Melhorias na interface e novos recursos disponíveis.</p>
                                <p class="text-xs text-gray-400 mt-2">Publicado em: 10/06/2023</p>
                            </div>
                        </div>
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
                @if($fatura->status == 'Paga')
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                        Paga
                    </span>
                @else
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                        Pendente
                    </span>
                @endif
            @else
                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                    Sem fatura
                </span>
            @endif
        </td>
        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
            @if($fatura && $fatura->path)
                <a href="{{ Storage::url($fatura->path) }}" 
                   target="_blank"
                   class="text-secondary hover:text-secondary-dark mr-2">
                    <i class="bi bi-eye"></i>
                </a>
                <a href="{{ route('faturas.download', $fatura->id) }}" 
                   class="text-primary hover:text-primary-dark">
                    <i class="bi bi-download"></i>
                </a>
            @else
                <span class="text-gray-400 text-xs">Nenhuma ação disponível</span>
            @endif
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="5" class="px-6 py-4 text-center text-sm text-gray-500">
            Nenhum pedido recente encontrado
        </td>
    </tr>
    @endforelse
</tbody>
        </table>
    </div>
</div> 

</div>

            </div>
            <!-- Container Principal - Ticker Horizontal Infinito -->
<div class="relative w-full mt-4 rounded-lg shadow-md overflow-hidden">
    <!-- Cabeçalho -->
    <div class="bg-primary text-white px-4 py-3 flex justify-between items-center">
        <h2 class="text-lg font-bold whitespace-nowrap"> <i class="bi bi-gear"></i> SERVIÇOS EM DESTAQUE</h2>
        <a href="}" class="text-sm font-semibold bg-white text-blue-600 hover:bg-gray-100 px-3 py-1 rounded whitespace-nowrap">
            SOLICITAR NOVO SERVIÇO
        </a>
    </div>

    <!-- Área de Rolagem -->
    <div class="relative overflow-hidden">
        <div class="servicos-ticker-container py-4">
            <div class="servicos-track flex gap-4 whitespace-nowrap">
                <!-- Primeira Passagem (visível) -->
                @foreach($servicos as $servico)
                <div class="servico-card inline-block w-auto border-l-4 border-blue-300 bg-gray-50 hover:bg-gray-100 transition-all">
                    <a href="" class="block p-4">
                        <div class="flex items-start gap-3">
                            <div class="bg-blue-100 text-blue-600 p-2 rounded-lg">
                                <i class="bi bi-{{ $servico->categoria->icone ?? 'star' }} text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800 whitespace-normal">{{ $servico->nome }}</h3>
                                <p class="text-sm text-gray-600 mt-1 line-clamp-2 whitespace-normal">{{ $servico->descricao }}</p>
                                <div class="mt-2 flex justify-between items-center">
                                    <span class="text-xs bg-gray-200 text-gray-700 px-2 py-1 rounded">
                                        {{ $servico->categoria->nome ?? 'Geral' }}
                                    </span>
                                    <span class="text-xs font-bold text-green-600">Kzs {{ number_format($servico->preco, 2, ',', '.') }}</span>
                                    <a href="{{ route('services.show', $servico->id) }}" class="text-[#00c476] hover:text-[#00a566] font-medium flex items-center">
                                <i class="bi bi-plus ml-1"></i> Fazer pedido 
                            </a>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach

                <!-- Segunda Passagem (cópia para efeito infinito) -->
                @foreach($servicos as $servico)
                <div class="servico-card inline-block w-64 border-l-4 border-blue-300 bg-gray-50 hover:bg-gray-100 transition-all" aria-hidden="true">
                    <a href="" class="block p-4">
                        <div class="flex items-start gap-3">
                            <div class="bg-red-100 text-blue-600 p-2 rounded-lg">
                                <i class="bi bi-{{ $servico->categoria->icone ?? 'star' }} text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-gray-800 whitespace-normal">{{ $servico->nome }}</h3>
                                <p class="text-sm text-gray-600 mt-1 line-clamp-2 whitespace-normal">{{ $servico->descricao }}</p>
                                <div class="mt-2 flex justify-between items-center">
                                    <span class="text-xs bg-blue-200 text-gray-700 px-2 py-1 rounded mr-4">
                                        {{ $servico->categoria->nome ?? 'Geral' }}
                                    </span>
                                    <span class="text-xs font-bold text-green-600">Kzs {{ number_format($servico->preco, 2, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>

                        <!-- Rodapé -->
                        <div class="bg-gray-100 px-4 py-2 text-right border-t">
                            <a href="/services" class="text-sm font-semibold text-green-600 hover:text-green-800 whitespace-nowrap">
                                VER TODOS OS SERVIÇOS →
                            </a>
                        </div>
                    </div>


                </div>
            </main>
    
        <x-deepbar />


    </body>
</html>