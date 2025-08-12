<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elprime Solution</title>
    <!-- Adicione o Alpine JS -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <style>
        @keyframes bgPulse {
            0% { background-color: rgba(255, 255, 255, 0.8); }
            50% { background-color: rgba(0, 196, 118, 0.2); }
            100% { background-color: rgba(255, 255, 255, 0.8); }
        }
        .animate-bg-pulse {
            animation: bgPulse 8s infinite ease-in-out;
        }
        
        [x-cloak] { display: none !important; }
        
        @media (max-width: 640px) {
            #header {
                width: calc(100% - 1rem) !important;
                top: 0.5rem !important;
            }
        }
    </style>
</head>
<body>
    <!-- Adicione x-data para gerenciar o estado do menu -->
    <header id="header" class="fixed left-1/2 transform -translate-x-1/2 bg-white/80 backdrop-blur-sm transition-all duration-1000 z-50 rounded-2xl shadow-lg animate-bg-pulse" style="width: calc(100% - 2rem); top: 1rem; max-width: 1800px;" x-data="{open: false, 
    servicesOpen: false, 
    webDevOpen: false, }">
        <div class="container mx-auto flex justify-between items-center p-4">
            <!-- Logo -->
            <a href="#inicio" class="flex items-center">
                <img src="/img/logomarca.png" alt="Elprime Solution" class="h-8 sm:h-10 md:h-12">
            </a>

            <!-- Menu Desktop -->
            <nav class="hidden md:flex gap-4 lg:gap-6 xl:gap-8 items-center">
                <a href="/" class="text-[#004b8d] hover:text-[#00c476] font-medium transition-colors duration-300 text-sm lg:text-base">Início</a>
                <a href="/#about" class="text-[#004b8d] hover:text-[#00c476] font-medium transition-colors duration-300 text-sm lg:text-base">Sobre</a><!-- Menu Desktop - Substitua o item Serviços por este código -->
                <div class="relative group" x-data="{ open: false, subOpen: false }">
                    <button @click="open = !open" @mouseenter="open = true"  onclick="document.getElementById('servicos').scrollIntoView()" @mouseleave="open = false" 
                            class="text-[#004b8d] hover:text-[#00c476] font-medium transition-colors duration-300 text-sm lg:text-base flex items-center gap-1">
                        Serviços
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 transition-transform duration-200" :class="{'rotate-180': open}" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    
                    <!-- Dropdown principal -->
                    <div x-show="open" @mouseenter="open = true" @mouseleave="open = false" 
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95"
                        class="absolute left-0 mt-2 w-56 origin-top-left rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50">
                        <div class="py-1">
                            <!-- Item 1 com submenu -->
                            <div class="relative">
                                <button @click="subOpen = !subOpen" @mouseenter="subOpen = true"
                                        class="flex justify-between items-center w-full px-4 py-2 text-sm text-left text-[#004b8d] hover:bg-gray-100">
                                    Consultoria e Assessoria
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                                
                                <!-- Submenu -->
                                <div x-show="subOpen" @mouseenter="subOpen = true" @mouseleave="subOpen = false"
                                    x-transition:enter="transition ease-out duration-200"
                                    x-transition:enter-start="opacity-0 scale-95"
                                    x-transition:enter-end="opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-150"
                                    x-transition:leave-start="opacity-100 scale-100"
                                    x-transition:leave-end="opacity-0 scale-95"
                                    class="absolute left-full top-0 ml-1 w-56 origin-top-left rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 z-50">
                                    <div class="py-1">
                                        <a href="#" class="block px-4 py-2 text-sm text-[#004b8d] hover:bg-gray-100">Contabilidade</a>
                                        <a href="#" class="block px-4 py-2 text-sm text-[#004b8d] hover:bg-gray-100">Finanças</a>
                                        <a href="#" class="block px-4 py-2 text-sm text-[#004b8d] hover:bg-gray-100">Fiscalidade</a>
                                        <a href="#" class="block px-4 py-2 text-sm text-[#004b8d] hover:bg-gray-100">Recursos humanos</a>
                                        <a href="#" class="block px-4 py-2 text-sm text-[#004b8d] hover:bg-gray-100">Tecnologia de informação</a>
                                        <a href="#" class="block px-4 py-2 text-sm text-[#004b8d] hover:bg-gray-100">Gestão empresarial</a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Outros itens do menu principal -->
                            <a href="#" class="block px-4 py-2 text-sm text-[#004b8d] hover:bg-gray-100">Estágio, treinamento e colocação</a>
                            <a href="#" class="block px-4 py-2 text-sm text-[#004b8d] hover:bg-gray-100">Energia e instalações eléctricas</a>
                            <a href="#" class="block px-4 py-2 text-sm text-[#004b8d] hover:bg-gray-100">Electrónica</a>
                            <a href="#" class="block px-4 py-2 text-sm text-[#004b8d] hover:bg-gray-100">Mecânica</a>
                        </div>
                    </div>
                </div>

                <!-- Menu Mobile - Substitua o item Serviços por este código -->
                <div class="md:hidden">
                    <button @click="servicesOpen = !servicesOpen" class="flex justify-between items-center w-full text-white hover:text-[#004b8d] py-2 font-medium text-sm sm:text-base">
                        Serviços
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2 transition-transform duration-200" :class="{'rotate-90': servicesOpen}" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    
                    <div x-show="servicesOpen" x-collapse class="pl-4">
                        <!-- Item com submenu -->
                        <div>
                            <button @click="webDevOpen = !webDevOpen" class="flex justify-between items-center w-full text-white hover:text-[#004b8d] py-1 sm:py-2 font-medium text-sm sm:text-base">
                                Desenvolvimento Web
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 ml-2 transition-transform duration-200" :class="{'rotate-90': webDevOpen}" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                </svg>
                            </button>
                            
                            <div x-show="webDevOpen" x-collapse class="pl-4">
                                <a href="#" class="block text-white hover:text-[#004b8d] py-1 sm:py-2 text-sm sm:text-base">Sites Institucionais</a>
                                <a href="#" class="block text-white hover:text-[#004b8d] py-1 sm:py-2 text-sm sm:text-base">Lojas Virtuais</a>
                                <a href="#" class="block text-white hover:text-[#004b8d] py-1 sm:py-2 text-sm sm:text-base">Sistemas Web</a>
                                <a href="#" class="block text-white hover:text-[#004b8d] py-1 sm:py-2 text-sm sm:text-base">Aplicações Progressivas</a>
                                <a href="#" class="block text-white hover:text-[#004b8d] py-1 sm:py-2 text-sm sm:text-base">Portais Corporativos</a>
                                <a href="#" class="block text-white hover:text-[#004b8d] py-1 sm:py-2 text-sm sm:text-base">Landing Pages</a>
                            </div>
                        </div>
                        
                        <!-- Outros itens -->
                        <a href="#" class="block text-white hover:text-[#004b8d] py-1 sm:py-2 text-sm sm:text-base">Marketing Digital</a>
                        <a href="#" class="block text-white hover:text-[#004b8d] py-1 sm:py-2 text-sm sm:text-base">Consultoria em TI</a>
                        <a href="#" class="block text-white hover:text-[#004b8d] py-1 sm:py-2 text-sm sm:text-base">Hospedagem Cloud</a>
                        <a href="#" class="block text-white hover:text-[#004b8d] py-1 sm:py-2 text-sm sm:text-base">Manutenção de Sites</a>
                    </div>
                </div>
                <a href="/#products" class="text-[#004b8d] hover:text-[#00c476] font-medium transition-colors duration-300 text-sm lg:text-base">Produtos</a>
                <a href="/#team" class="text-[#004b8d] hover:text-[#00c476] font-medium transition-colors duration-300 text-sm lg:text-base">Equipa</a>
                <a href="/#blog" class="text-[#004b8d] hover:text-[#00c476] font-medium transition-colors duration-300 text-sm lg:text-base">Blog</a>
                <a href="/#gallery" class="text-[#004b8d] hover:text-[#00c476] font-medium transition-colors duration-300 text-sm lg:text-base">Galeria</a>
                <a href="/#contato" class="text-[#004b8d] hover:text-[#00c476] font-medium transition-colors duration-300 text-sm lg:text-base">Contactos</a>
                                @guest
                <button onclick="location.href='/login'" aria-label="Login" class="bg-gradient-to-r from-[#004b8d] to-[#00c476] hover:from-[#00c476] hover:to-[#004b8d] text-white px-4 py-1 md:px-5 md:py-1.5 lg:px-6 lg:py-2 rounded-full transition-all duration-500 flex items-center shadow-md hover:shadow-lg text-sm lg:text-base">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 md:h-5 md:w-5 mr-1 md:mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                    </svg> Login
                </button>
                @else
                <button onclick="location.href='/dashboard'" aria-label="Login" class="bg-gradient-to-r from-[#004b8d] to-[#00c476] hover:from-[#00c476] hover:to-[#004b8d] text-white px-4 py-1 md:px-5 md:py-1.5 lg:px-6 lg:py-2 rounded-full transition-all duration-500 flex items-center shadow-md hover:shadow-lg text-sm lg:text-base">{{ Auth::user()->name }} </button>
                @endguest
            </nav>

            <!-- Menu Mobile (Hamburger) -->
            <button class="md:hidden text-[#004b8d]" @click="open = !open" aria-label="Menu mobile">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <!-- Menu Mobile (Dropdown) -->
        <div class="md:hidden bg-gradient-to-b from-[#004b8d] to-[#00c476] transition-all duration-300 overflow-hidden rounded-b-2xl" x-show="open" @click.away="open = false" x-cloak>
            <div class="container mx-auto px-4 py-2 flex flex-col gap-2 sm:gap-3">
                <a href="#inicio" class="text-white hover:text-[#004b8d] py-1 sm:py-2 font-medium text-sm sm:text-base" @click="open = false">Início</a>
                <a href="#about" class="text-white hover:text-[#004b8d] py-1 sm:py-2 font-medium text-sm sm:text-base" @click="open = false">About</a>
                <a href="#servicos" class="text-white hover:text-[#004b8d] py-1 sm:py-2 font-medium text-sm sm:text-base" @click="open = false">Serviços</a>
                <a href="#projetos" class="text-white hover:text-[#004b8d] py-1 sm:py-2 font-medium text-sm sm:text-base" @click="open = false">Projetos</a>
                <a href="#contato" class="text-white hover:text-[#004b8d] py-1 sm:py-2 font-medium text-sm sm:text-base" @click="open = false">Contato</a>
                
                
                
                @guest
                <button onclick="location.href='/login'" aria-label="Login" class="bg-gradient-to-r from-[#004b8d] to-[#00c476] hover:from-[#00c476] hover:to-[#004b8d] text-white px-4 py-1 md:px-5 md:py-1.5 lg:px-6 lg:py-2 rounded-full transition-all duration-500 flex items-center shadow-md hover:shadow-lg text-sm lg:text-base">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 md:h-5 md:w-5 mr-1 md:mr-2" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                    </svg> Login
                </button>
                @else
                <button onclick="location.href='/dashboard'" aria-label="Login" class="bg-gradient-to-r from-[#004b8d] to-[#00c476] hover:from-[#00c476] hover:to-[#004b8d] text-white px-4 py-1 md:px-5 md:py-1.5 lg:px-6 lg:py-2 rounded-full transition-all duration-500 flex items-center shadow-md hover:shadow-lg text-sm lg:text-base">{{ Auth::user()->name }} </button>
                @endguest

            </div>
        </div>
    </header>

    <script>
        // Ajuste dinâmico da largura e posição durante o scroll
        window.addEventListener('scroll', () => {
            const header = document.getElementById('header');
            const scrollY = window.scrollY;
            
            // Reduz a margem superior gradualmente
            const newTop = Math.max(16 - scrollY / 3, 8);
            header.style.top = `${newTop}px`;
            
            // Reduz a largura gradualmente
            const widthReduction = Math.min(scrollY / 2, 20);
            header.style.width = `calc(100% - ${32 - widthReduction}px)`;
            
            // Adiciona sombra mais intensa ao scrollar
            if (scrollY > 10) {
                header.classList.add('shadow-xl');
                header.classList.remove('shadow-lg');
            } else {
                header.classList.add('shadow-lg');
                header.classList.remove('shadow-xl');
            }
        });

        // Ajuste inicial para telas pequenas
        window.addEventListener('DOMContentLoaded', () => {
            if (window.innerWidth < 640) {
                const header = document.getElementById('header');
                header.style.width = 'calc(100% - 1rem)';
                header.style.top = '0.5rem';
            }
        });
    </script>
</body>
</html>