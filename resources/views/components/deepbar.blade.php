<footer class="bg-gradient-to-r from-[#004b8d] to-[#00c476] text-white py-6">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Seção 1 - Logo e descrição -->
            <div class="mb-4 md:mb-0">
                <div class="flex items-center mb-3">
                    <img class="h-6 w-auto mr-2" src="{{ asset('img/logomarca.png') }}" alt="Logo">
                    <span class="text-lg font-semibold">{{ config('app.name') }}</span>
                </div>
                <p class="text-white/80 text-sm">Soluções digitais para simplificar seu dia a dia.</p>
            </div>
            
            
         
        </div>
        
        <div class="border-t border-white/20 mt-6 pt-6 text-center text-white/80 text-xs">
            &copy; {{ date('Y') }} {{ config('app.name') }}. Todos os direitos reservados.
        </div>
    </div>
</footer>