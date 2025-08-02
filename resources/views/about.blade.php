@extends('layouts.app')    
@section('content')   
<!-- About Section - Versão Simplificada e Otimizada -->
<section id="about" class="relative py-20 mt-20 bg-gradient-to-br from-white to-gray-50">
    <div class="container mx-auto px-4">
    <h2 class="text-3xl md:text-4xl font-bold text-[rgb(0,75,141)] mb-10">
                        Sobre<span class="text-[#00c476]"> nós</span>  
                    </h2>
    <div class="grid md:grid-cols-2 gap-16 items-center">
            <!-- Imagem Ampliada -->
            <div class="relative h-full min-h-[500px]">
                <img src="/img/banner.jpg" alt="Nossa equipe" 
                     class="absolute h-full w-full object-cover rounded-lg shadow-xl transition-transform duration-500 hover:scale-105">
            </div>

            <!-- Conteúdo -->
            <div class="space-y-8">
                <!-- Cabeçalho -->
                <div class="space-y-4">
                    <span class="text-[#00c476] font-semibold tracking-wide">
                        Elprime Solution
                    </span>
                    <h2 class="text-xl md:text-xl font-bold text-[#004b8d]">
                        Óptima <span class="text-[#00c476]">solução</span> para o mercado 
                    </h2>
                    <p class="text-gray-600 leading-relaxed text-justify">
                    A Elprime Solution, é uma empresa de direito angolano, com número de identificação fiscal 5001132644, com sede em Luanda, sob número de matrícula 38309-22/220816. vocacionada nas diversas áreas de serviços de Consultoria e Assessoria para empresas , Tecnologia de Informação, Energia e Instalações Eléctricas, Treinamento, Capacitação e Estágio Supervisionado, podendo ainda exercer outras Actividades Mercantis que a lei lhe permite.
                    </p>
                </div>

                <!-- Lista em 2 colunas -->
                <div class="grid grid-cols-2 gap-4">
                    <!-- Item 1 -->
                    <div class="flex items-start gap-3 p-4 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow">
                        <div class="bg-[#00c476]/10 p-2 rounded-full flex-shrink-0">
                            <svg class="w-6 h-6 text-[#00c476]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <span class="text-gray-700">+5 anos de experiência</span>
                    </div>
                    
                    <!-- Item 2 -->
                    <div class="flex items-start gap-3 p-4 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow">
                        <div class="bg-[#00c476]/10 p-2 rounded-full flex-shrink-0">
                            <svg class="w-6 h-6 text-[#00c476]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <span class="text-gray-700">Projetos personalizados</span>
                    </div>
                    
                    <!-- Item 3 -->
                    <div class="flex items-start gap-3 p-4 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow">
                        <div class="bg-[#00c476]/10 p-2 rounded-full flex-shrink-0">
                            <svg class="w-6 h-6 text-[#00c476]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <span class="text-gray-700">Tecnologias modernas</span>
                    </div>
                    
                    <!-- Item 4 -->
                    <div class="flex items-start gap-3 p-4 bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow">
                        <div class="bg-[#00c476]/10 p-2 rounded-full flex-shrink-0">
                            <svg class="w-6 h-6 text-[#00c476]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                        <span class="text-gray-700">Abordagem inovadora</span>
                    </div>
                </div>

                    <!-- Nova Seção: Missão, Visão e Valores -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-8">
                    <!-- Missão -->
                    <div class="bg-white p-6  shadow-sm hover:shadow-md transition-shadow border-l-4 border-[#004b8d]">
                        <div class="text-[#004b8d] mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-[#004b8d] mb-2">Missão</h3>
                        <p class="text-gray-600 text-sm text-justify">Está virada ao comprometimento e foco no cliente, isto é, auxiliando os seus profissionais e os clientes a obterem resultados excelentes.</p>
                    </div>

                    <!-- Visão -->
                    <div class="bg-white p-6  shadow-sm hover:shadow-md transition-shadow border-r-4 border-[#004b8d]">
                        <div class="text-[#004b8d] mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-[#004b8d] mb-2">Visão</h3>
                        <p class="text-gray-600 text-sm text-justify">Nossa visão é ter um padrão de excelência na agregação de valores aos nossos clientes oferecendo-lhes soluções óptimas de referências para o mercado.</p>
                    </div>
                </div>
                                    <!-- Valores -->
                        <div class="bg-white p-6  shadow-sm hover:shadow-md transition-shadow border-t-4 border-[#004b8d]">
                        <div class="text-[#004b8d] mb-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-[#004b8d] mb-2">Valores</h3>
                        <p class="text-gray-600 text-sm text-justify">
                        Envolvem a disciplina, o comprimisso mútuo pelo reconhecimento e compartilhamento de conhecimentos, a integridade e identidade na conduta profissional, o foco na proficiência, integração social e a geração de valor para os clientes.
                        </p>
                    </div>


            
            </div>
        </div>
    </div>
</section>
