<!-- Hero Section com Texto Dinâmico e Botão Animado -->
<section id="inicio" class="relative h-screen overflow-hidden">
    <!-- Imagem de fundo com fallback -->
<div class="absolute inset-0 bg-[#004b8d] bg-no-repeat bg-center bg-cover opacity-70" style="background-image: url('/img/hero.png');">
    </div>
    
    <!-- Overlay escuro -->
    <div class="absolute inset-0 bg-[#061a2bce]"></div>
    
    <!-- Partículas (herdadas do seu código base) -->
    <div id="particles-js" class="absolute inset-0 opacity-60"></div>
    
    <!-- Conteúdo principal -->
    <div class="relative z-10 flex flex-col items-center justify-center h-full text-center px-4 text-[#00c476]">
            
            <!-- Botão CTA com efeito de scroll integrado -->
            <div class="mt-12">
                <a href="#contato" 
                   class="cta-button mt-10 inline-flex items-center px-8 py-4 bg-gradient-to-r from-[#004b8d] to-[#00c476] text-white font-bold rounded-full hover:shadow-xl transition-all duration-500 transform hover:scale-105 group relative overflow-hidden">
                    <span class="relative z-10">Comece seu projeto agora</span>
                    
                    <!-- Efeito de onda animado -->
                    <span class="absolute inset-0 flex items-center justify-center">
                        <span class="wave-effect absolute bg-white/20 rounded-full scale-0 group-hover:scale-100 group-hover:opacity-0 transition-all duration-700 ease-in-out"></span>
                    </span>
                    
                    <!-- Efeito de scroll animado (substitui o ícone) -->
                    <span class="scroll-hint absolute -bottom-16 left-1/2 transform -translate-x-1/2 opacity-0 group-hover:opacity-100 group-hover:-bottom-20 transition-all duration-500">
                        <svg class="w-6 h-6 animate-bounce" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                        </svg>
                    </span>
                </a>
            </div>
        </div>
    </div>
</section>

<style>
    /* Animação do texto dinâmico */
    [x-transition\:leave] {
        position: absolute;
        left: 0;
        right: 0;
    }
    
    /* Efeito do botão */
    .cta-button {
        box-shadow: 0 4px 15px rgba(0, 196, 118, 0.3);
    }
    
    .wave-effect {
        width: 200%;
        padding-bottom: 200%;
        transition: all 0.7s ease-in-out;
    }
    
    /* Animação do scroll hint */
    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% { transform: translateY(0) translateX(-50%); }
        40% { transform: translateY(-10px) translateX(-50%); }
        60% { transform: translateY(-5px) translateX(-50%); }
    }
    .animate-bounce {
        animation: bounce 2s infinite;
    }
    
    /* Garante espaço para o efeito de scroll */
    .cta-button {
        padding-bottom: 1.5rem;
        margin-bottom: 2rem;
    }
</style>

