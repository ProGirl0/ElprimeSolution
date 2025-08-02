<!-- Seção Partners - Versão Corrigida -->
<section class="relative py-12 bg-gray-100 overflow-hidden">
    <!-- Efeito de borda superior -->
    <div class="absolute top-0 left-0 right-0 h-1 bg-gradient-to-r from-[#004b8d] via-[#00c476] to-[#004b8d]"></div>
    
    <!-- Container principal -->
    <div class="container mx-auto px-4">
        
        <!-- Carrossel Automático Corrigido -->
        <div x-data="carrosselParceiros()" class="relative overflow-hidden py-4">
            <!-- Faixa animada -->
            <div class="absolute bottom-0 left-0 right-0 h-1 bg-gradient-to-r from-[#004b8d] via-[#00c476] to-[#004b8d] animate-marquee"></div>
            
            <!-- Lista de parceiros -->
            <div class="flex" x-ref="track">
                <template x-for="(partner, index) in partners" :key="index">
                    <div class="flex-shrink-0 mx-4 flex items-center justify-center  transform hover:scale-105 transition-all duration-300">
                        <img :src="partner.logo" :alt="partner.name" class="h-12 object-contain max-w-[180px]">
                    </div>
                </template>
            </div>
        </div>
        
    </div>
</section>

<script>
// Função separada para o carrossel
function carrosselParceiros() {
    return {
        partners: [
            { name: 'Microsoft', logo: '/img/partners/ms.png' },
            { name: 'Google', logo: '/img/partners/google.png' },
            { name: 'Amazon', logo: '/img/partners/aws.webp' },
            { name: 'IBM', logo: '/img/partners/ibm.webp' },
            { name: 'Oracle', logo: '/img/partners/oracle.png' },
            { name: 'Cisco', logo: '/img/partners/cisco.png' }
        ],
        speed: 0.5,
        position: 0,
        direction: -1,
        init() {
            // Duplica os itens para efeito infinito
            this.partners = [...this.partners, ...this.partners];
            
            const animate = () => {
                this.position += this.speed * this.direction;
                
                if (Math.abs(this.position) > this.$refs.track.scrollWidth / 2) {
                    this.position = 0;
                }
                
                this.$refs.track.style.transform = `translateX(${this.position}px)`;
                requestAnimationFrame(animate);
            };
            
            animate();
        }
    }
}
</script>

<style>
/* Animações */
@keyframes marquee {
    0% { background-position: 0% 50%; }
    100% { background-position: 100% 50%; }
}
.animate-marquee {
    background-size: 200% 100%;
    animation: marquee 3s linear infinite;
}

@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.7; }
}
.animate-pulse {
    animation: pulse 2s infinite;
}
</style>
