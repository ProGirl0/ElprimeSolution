<nav class="bg-gradient-to-r from-[#004b8d] to-[#00c476] shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Logo à esquerda -->
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}" class="flex-shrink-0 flex items-center hover:opacity-90 transition-opacity">
                    <img class="h-8 w-auto" src="{{ asset('img/logomarca.png') }}" alt="Logo">
                    <span class="ml-2 text-xl font-semibold text-white hidden sm:inline">Elprime Solution</span>
                </a>
            </div>

            <!-- Links centrais -->
            <div class="hidden md:flex items-center space-x-6">
                @foreach([
                    'home' => ['route' => 'dashboard', 'icon' => 'bi-house', 'label' => 'Home'],
                    'services' => ['route' => 'services.index', 'icon' => 'bi-gear', 'label' => 'Serviços'],
                    'requests' => ['route' => 'pedidos.historico', 'icon' => 'bi-file-text', 'label' => 'Pedidos'],
                    'notifications' => ['route' => 'notifications.index', 'icon' => 'bi-bell', 'label' => 'Notificações']
                ] as $key => $link)
                    <a href="{{ route($link['route']) }}" 
                       class="{{ request()->routeIs($link['route']) ? 'bg-white/20 text-white' : 'text-white/70 hover:text-white hover:bg-white/10' }} 
                              rounded-lg px-4 py-2 flex items-center font-medium transition-all duration-200 group">
                        <i class="bi {{ $link['icon'] }} text-lg"></i>
                        <span class="ml-2">{{ $link['label'] }}</span>
                    </a>
                @endforeach
            </div>

            <!-- Avatar e dropdown à direita -->
            <div class="flex items-center">
                <div class="ml-3 relative">
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none hover:opacity-80 transition-opacity">
                            @if(Auth::user()->profile_photo_url)
                                <img class="h-8 w-8 rounded-full border-2 border-white/80 hover:border-white" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}">
                            @else
                                <div class="h-8 w-8 rounded-full bg-white/10 flex items-center justify-center">
                                    <i class="bi bi-person-circle text-xl text-white"></i>
                                </div>
                            @endif
                            <span class="hidden md:inline text-white text-sm font-medium">{{ Auth::user()->name }}</span>
                        </button>

                        <!-- Dropdown -->
                        <div x-show="open" 
                             @click.away="open = false"
                             x-transition:enter="transition ease-out duration-100"
                             x-transition:enter-start="transform opacity-0 scale-95"
                             x-transition:enter-end="transform opacity-100 scale-100"
                             x-transition:leave="transition ease-in duration-75"
                             x-transition:leave-start="transform opacity-100 scale-100"
                             x-transition:leave-end="transform opacity-0 scale-95"
                             class="origin-top-right absolute right-0 mt-2 w-56 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-50">
                            <div class="py-1">
                                <div class="px-4 py-3 text-sm text-gray-700 border-b">
                                    <div class="font-medium truncate">{{ Auth::user()->email }}</div>
                                    <div class="text-gray-500 truncate">Logado como: {{ Auth::user()->name }}</div>
                                </div>
                                <a href="{{ route('profile.edit') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#004b8d] transition-colors">
                                    <i class="bi bi-person mr-3 text-[#00c476]"></i> Meu Perfil
                                </a>
                                <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#004b8d] transition-colors">
                                    <i class="bi bi-house mr-3 text-[#00c476]"></i> Dashboard
                                </a>
                                <a href="#" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#004b8d] transition-colors">
                                    <i class="bi bi-question-circle mr-3 text-[#00c476]"></i> Ajuda & Suporte
                                </a>
                                <div class="border-t border-gray-100"></div>
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 hover:text-[#004b8d] transition-colors">
                                        <i class="bi bi-box-arrow-right mr-3 text-[#00c476]"></i> Sair
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>