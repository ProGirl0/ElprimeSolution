<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Elprime Solution | {{ $categoria->nome }} - {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="shortcut icon" href="/img/logomarca.png" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 75, 141, 0.2);
        }
        .price-tag {
            background: linear-gradient(135deg, #00c476, #00a566);
        }
        .service-type {
            background-color: #f0f9ff;
            color: #004b8d;
        }
    </style>
</head>
<body class="bg-gray-50">
    @include('profile.partials.header')
    <main class="container mx-auto px-4 py-40">
        <!-- Cabeçalho da Categoria -->
        <div class="mb-12 text-center">
            <h1 class="text-3xl md:text-4xl font-bold text-[#004b8d] mb-4">{{ $categoria->nome }}</h1>
            <p class="text-lg text-gray-600 max-w-3xl mx-auto">{{ $categoria->descricao }}</p>
        </div>

        <!-- Lista de Serviços -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($categoria->services as $service)
                <div class="service-card bg-white rounded-xl shadow-md overflow-hidden transition-all duration-300">
                    <div class="p-6">
                        <!-- Tipo de Serviço -->
                        <span class="service-type inline-flex items-center px-3 py-1 rounded-full text-xs font-medium mb-3">

                            Elprime Solution
                        </span>
                        
                        <!-- Nome do Serviço -->
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $service->nome }}</h3>
                        
                        <!-- Descrição -->
                        <p class="text-gray-600 mb-4">{{ $service->descricao }}</p>
                        
                        <!-- Rodapé do Card -->
                        <div class="flex justify-between items-center">
                            <!-- Preço -->
                            <div class="price-tag text-white px-3 py-1 rounded-full text-sm font-medium inline-flex items-center">
                            <i class="bi bi-tag-fill mr-1"></i>
                                {{ number_format($service->preco, 2, ',', '.') }} Kz
                            </div>
                            
                            <!-- Ver detalhes -->
                            <a href="{{ route('services.show', $service->id) }}" class="text-[#00c476] hover:text-[#00a566] font-medium flex items-center">
                                <i class="bi bi-plus ml-1"></i> Fazer pedido 
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Botão Voltar -->
        <div class="mt-12 text-center">
            <a href="{{ url()->previous() }}" 
               class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md text-[#004b8d] bg-white hover:bg-gray-50 shadow-sm">
                <i class="bi bi-arrow-left mr-2"></i> Voltar
            </a>
        </div>
    </main>

    @include('profile.partials.footer')
</body>
</html>