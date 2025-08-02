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

</head>
<body class="font-sans bg-gray-50">
    <x-navbar />
    
    <main class="min-h-[calc(100vh-160px)]">
        <!-- Card de Notificações -->
<div class="bg-white rounded-lg shadow p-6 m-10">
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
    

</div>

    </main>
    
    <x-deepbar   />

    @stack('scripts')
</body>
</html> 