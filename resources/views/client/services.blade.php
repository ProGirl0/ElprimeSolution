@extends('layouts.app')


@section('content')   
@php
    $categorias = $servicos->groupBy('categoria.nome');
@endphp


    @foreach($categorias as $nomeCategoria => $servicosDaCategoria)
    <section class="mb-8 mx-10 px-10 mt-28 ">
        <div class="flex items-center mb-4">
            <div class="bg-[#00c476] text-white p-2 rounded-lg mr-3">
                <i class="bi bi-{{ $servicosDaCategoria->first()->categoria->icone ?? 'star' }} text-xl"></i>
            </div>
            <h2 class="text-xl font-bold text-gray-800">{{ $nomeCategoria ?? 'Geral' }}</h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4">
            @foreach($servicosDaCategoria as $servico)
            <div class="servico-card bg-white  shadow-md hover:shadow-lg transition-all duration-300 border-l-4 border-blue-900 overflow-hidden">
                <a href="{{ route('services.show', $servico->id) }}" class="block h-full">
                    <div class="p-4 h-full flex flex-col">
                        <div class="flex-grow">
                            <h3 class="font-bold text-gray-800 text-lg">{{ $servico->nome }}</h3>
                            <p class="text-sm text-gray-600 mt-2 line-clamp-3">{{ $servico->descricao }}</p>
                        </div>
                        
                        <div class="mt-4 pt-3 border-t border-green-300">
                            <span class="text-sm font-bold text-[#00c476] block mb-2">Kzs {{ number_format($servico->preco, 2, ',', '.') }}</span>
                            
                            <button class="w-full bg-gradient-to-r from-[#00c476] to-blue-900 text-white py-2 px-4 rounded-md hover:opacity-90 transition-opacity flex items-center justify-center">
                                <i class="bi bi-plus-circle mr-2"></i> Fazer pedido
                            </button>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </section>
    @endforeach

@endsection