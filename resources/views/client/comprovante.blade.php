<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comprovante de Pagamento | {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" 
          integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" 
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        .bg-custom-blue {
            background-color: #1e40af; /* Equivalente ao blue-800 */
            
        }

         .btn-download {
        border: 1px solid #059669; /* green-600 */
        color: #059669;
    }
    .btn-back {
        border: 1px solid #1e40af; /* blue-800 */
        color: #1e40af;
    }
    </style>
</head>
<body class="font-sans bg-gray-50">
    <x-navbar />

    <div class="container mx-auto py-8 px-4">
        <!-- Cabeçalho -->
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-2xl font-semibold text-blue-800">Comprovante de Pagamento</h1>
            <a href="{{ url()->previous() }}" class="text-blue-800 hover:text-blue-600 flex items-center">
                <i class="fas fa-arrow-left mr-2"></i> Voltar
            </a>
        </div>

        <!-- Container principal -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <div class="flex flex-col md:flex-row">
                <!-- Seção da imagem (esquerda) -->
                <div class="w-full md:w-1/2 bg-blue-800 p-6 flex items-center justify-center">
                    @if($pagamento->path && Storage::disk('public')->exists($pagamento->path))
                        @php
                            $mime = Storage::disk('public')->mimeType($pagamento->path);
                        @endphp
                        
                        @if(strpos($mime, 'image/') === 0)
                            <img src="{{ Storage::url($pagamento->path) }}" 
                                 alt="Comprovante de pagamento"
                                 class="max-h-96 object-contain">
                        @elseif($mime == 'application/pdf')
                            <div class="text-center text-white">
                                <i class="fas fa-file-pdf text-6xl mb-4"></i>
                                <p class="text-xl">Visualização do PDF</p>
                                <p class="text-sm opacity-80 mt-2">Clique no botão abaixo para baixar</p>
                            </div>
                        @else
                            <div class="text-center text-white">
                                <i class="fas fa-file-alt text-6xl mb-4"></i>
                                <p class="text-xl">Comprovante em anexo</p>
                            </div>
                        @endif
                    @else
                        <div class="text-center text-white">
                            <i class="fas fa-times-circle text-6xl mb-4"></i>
                            <p class="text-xl">Comprovante não disponível</p>
                        </div>
                    @endif
                </div>

                <!-- Seção de informações (direita) -->
                <div class="w-full md:w-1/2 p-8">
                    <div class="mb-8">
                        <h2 class="text-xl font-bold text-blue-800 mb-4">Detalhes do Pagamento</h2>
                        
                        <div class="space-y-4">
                            <div>
                                <p class="text-sm text-gray-500">Número da Fatura</p>
                                <p class="text-lg font-semibold text-green-600">#{{ $fatura->pedido->code }}</p>
                            </div>
                            
                            <div>
                                <p class="text-sm text-gray-500">Status</p>
                                <span class="px-3 py-1 text-sm font-semibold rounded-full 
                                    @if($pagamento->status == 'aprovado') bg-green-100 text-green-800
                                    @elseif($pagamento->status == 'pendente') bg-yellow-100 text-yellow-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst($pagamento->status) }}
                                </span>
                            </div>
                            
                            <div>
                                <p class="text-sm text-gray-500">Data do Pagamento</p>
                                <p class="text-gray-800">{{ $pagamento->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                            
                            <div>
                                <p class="text-sm text-gray-500">Método de Pagamento</p>
                                <p class="text-gray-800">{{ ucfirst($pagamento->fatura->metodo_pagamento) }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-blue-800  font-semibold ">Total</p>
                                <p class="text-gray-800">Kzs {{ ucfirst($pagamento->fatura->total) }}</p>
                            </div>
                        </div>
                    </div>

                <!-- Ações -->
                <div class="border-t  pt-6 flex gap-4">
                    @if($pagamento->path && Storage::disk('public')->exists($pagamento->path))
                        <a href="{{ Storage::url($pagamento->path) }}" 
                        download
                        class="btn-download text-green-600 hover:bg-green-50 py-2 px-4 rounded-lg flex items-center justify-center transition-colors">
                            <i class="fas fa-download mr-2"></i> Baixar Comprovante
                        </a>
                    @endif
                    
                    <a href="/pedidos/historico" 
                    class="btn-back text-blue-800 hover:bg-blue-50 py-2 px-4 rounded-lg flex items-center justify-center transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i> Voltar para Pedidos
                    </a>
                </div>
                </div>
            </div>
        </div>

        <!-- Mensagem para PDF (se aplicável) -->
        @if($pagamento->path && Storage::disk('public')->exists($pagamento->path) && Storage::disk('public')->mimeType($pagamento->path) == 'application/pdf')
            <div class="mt-6 bg-blue-50 border border-blue-200 rounded-lg p-4 text-center">
                <p class="text-blue-800">Para visualizar o comprovante em PDF, clique no botão "Baixar Comprovante" acima.</p>
            </div>
        @endif
    </div>
</body>
</html>