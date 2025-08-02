<!-- Interactive Gallery Section -->
<section id="gallery" class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="text-center mb-16">
            
            <h2 class="text-4xl md:text-5xl font-bold text-[#004b8d] mt-4">
                Galeria <span class="text-[#00c476]"></span>
            </h2>

        </div>

        <!-- Gallery Layout -->
        <div class="flex flex-col lg:flex-row gap-8">
            <!-- Featured Slider (Left) -->
            <div class="lg:w-1/2 relative group" x-data="{ currentSlide: 0 }">
                <!-- Big Slider -->
                <div class="relative h-96 md:h-[500px] rounded-2xl overflow-hidden shadow-xl">
                    <!-- Slide 1 -->
                    <div x-show="currentSlide === 0" x-transition:enter="transition ease-out duration-500" 
                         x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                         class="absolute inset-0">
                        <img src="/img/galeria/1.jpg" alt="Projeto Hospitalar" 
                             class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#004b8d]/90 to-transparent flex items-end p-8">
                        <div>
                                <h3 class="text-white text-2xl font-bold">Elprime Solution</h3>
                                <p class="text-white/90 mt-2">03  Maio 2025 | Feira de StartUps</p>
                                <div class="h-1 w-16 bg-[#00c476] mt-4"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Slide 2 -->
                    <div x-show="currentSlide === 1" x-transition:enter="transition ease-out duration-500" 
                         x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
                         class="absolute inset-0">
                        <img src="/img/galeria/2.jpg" alt="Plataforma Educacional" 
                             class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-700">
                        <div class="absolute inset-0 bg-gradient-to-t from-[#004b8d]/90 to-transparent flex items-end p-8">
                            <div>
                                <h3 class="text-white text-2xl font-bold">Elprime Solution</h3>
                                <p class="text-white/90 mt-2">03  Maio 2025 | Feira de StartUps</p>
                                <div class="h-1 w-16 bg-[#00c476] mt-4"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation Arrows -->
                    <button @click="currentSlide = currentSlide === 0 ? 1 : 0" 
                            class="absolute left-4 top-1/2 transform -translate-y-1/2 bg-white/80 text-[#004b8d] w-10 h-10 rounded-full flex items-center justify-center shadow-md hover:bg-white transition-all">
                        <i class="bi bi-chevron-left text-xl"></i>
                    </button>
                    <button @click="currentSlide = currentSlide === 0 ? 1 : 0" 
                            class="absolute right-4 top-1/2 transform -translate-y-1/2 bg-white/80 text-[#004b8d] w-10 h-10 rounded-full flex items-center justify-center shadow-md hover:bg-white transition-all">
                        <i class="bi bi-chevron-right text-xl"></i>
                    </button>
                </div>

                <!-- Slider Indicators -->
                <div class="flex justify-center mt-6 space-x-2">
                    <button @click="currentSlide = 0" 
                            class="w-3 h-3 rounded-full transition-all" 
                            :class="currentSlide === 0 ? 'bg-[#00c476] w-6' : 'bg-gray-300'"></button>
                    <button @click="currentSlide = 1" 
                            class="w-3 h-3 rounded-full transition-all" 
                            :class="currentSlide === 1 ? 'bg-[#00c476] w-6' : 'bg-gray-300'"></button>
                </div>
            </div>

            <!-- Image Grid (Right) -->
            <div class="lg:w-1/2">
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    <!-- Project 1 -->
                    <a href="#" class="group relative block overflow-hidden rounded-xl aspect-square shadow-md hover:shadow-lg transition-all">
                        <img src="/img/galeria/3.jpg" alt="Projeto 1" 
                             class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-[#004b8d]/0 group-hover:bg-[#004b8d]/80 flex items-center justify-center transition-all duration-300">
                            <span class="text-transparent group-hover:text-white font-medium transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                            Feira de StartUps
                            </span>
                        </div>
                    </a>

                    <!-- Project 2 -->
                    <a href="#" class="group relative block overflow-hidden rounded-xl aspect-square shadow-md hover:shadow-lg transition-all">
                        <img src="/img/galeria/4.jpg" alt="Projeto 2" 
                             class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-[#004b8d]/0 group-hover:bg-[#004b8d]/80 flex items-center justify-center transition-all duration-300">
                            <span class="text-transparent group-hover:text-white font-medium transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                            Feira de StartUps
                            </span>
                        </div>
                    </a>

                    <!-- Project 3 -->
                    <a href="#" class="group relative block overflow-hidden rounded-xl aspect-square shadow-md hover:shadow-lg transition-all">
                        <img src="/img/galeria/5.jpg" alt="Projeto 3" 
                             class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-[#004b8d]/0 group-hover:bg-[#004b8d]/80 flex items-center justify-center transition-all duration-300">
                            <span class="text-transparent group-hover:text-white font-medium transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                            Feira de StartUps
                            </span>
                        </div>
                    </a>

                    <!-- Project 4 -->
                    <a href="#" class="group relative block overflow-hidden rounded-xl aspect-square shadow-md hover:shadow-lg transition-all">
                        <img src="/img/galeria/6.jpg" alt="Projeto 4" 
                             class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-[#004b8d]/0 group-hover:bg-[#004b8d]/80 flex items-center justify-center transition-all duration-300">
                            <span class="text-transparent group-hover:text-white font-medium transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                            Feira de StartUps
                            </span>
                        </div>
                    </a>

                    <!-- Project 5 -->
                    <a href="#" class="group relative block overflow-hidden rounded-xl aspect-square shadow-md hover:shadow-lg transition-all">
                        <img src="/img/galeria/7.jpg" alt="Projeto 5" 
                             class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-[#004b8d]/0 group-hover:bg-[#004b8d]/80 flex items-center justify-center transition-all duration-300">
                            <span class="text-transparent group-hover:text-white font-medium transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                            Feira de StartUps
                            </span>
                        </div>
                    </a>

                    <!-- Project 6 -->
                    <a href="#" class="group relative block overflow-hidden rounded-xl aspect-square shadow-md hover:shadow-lg transition-all">
                        <img src="/img/galeria/8.jpg" alt="Projeto 6" 
                             class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute inset-0 bg-[#004b8d]/0 group-hover:bg-[#004b8d]/80 flex items-center justify-center transition-all duration-300">
                            <span class="text-transparent group-hover:text-white font-medium transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                            Feira de StartUps
                            </span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>