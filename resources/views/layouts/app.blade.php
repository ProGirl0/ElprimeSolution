<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elprime Solution | óptima solução para sí</title>

    <link rel="shortcut icon" href="/img/logomarca.png" type="image/x-icon">
    <link rel="stylesheet" href="/build/assets/app.css">
       
        @production
        <link href="{{ asset('build/assets/app.css') }}" rel="stylesheet">
        <script src="{{ asset('build/assets/app2.js') }}" defer></script>
    @endproduction
<script src="https://cdn.jsdelivr.net/particles.js/2.0.0/particles.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@alpinejs/intersect@3.x.x/dist/cdn.min.js" defer></script>
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
<script src="/build/assets/app2.js"></script>

    @stack('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" 
          integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" 
          crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    
    
    <script src="https://cdn.botpress.cloud/webchat/v3.2/inject.js" defer></script>
<script src="https://files.bpcontent.cloud/2025/07/13/10/20250713105919-SA2KE2CP.js" defer></script>
    

</head>
<body class="font-sans antialiased">
    <!-- Header -->
    @include('profile.partials.header')

    <!-- Conteúdo Dinâmico -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    @include('profile.partials.footer')

    <!-- Scripts -->

<script src="{{ asset('js/particles-config.js') }}"></script>
 <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.5/dist/cdn.min.js" defer></script>
    @stack('scripts') <!-- Para scripts específicos de páginas -->
<script>
document.addEventListener('DOMContentLoaded', () => {
    Alpine.plugin(Intersect)
    Alpine.start()
})
</script>
</body>

</html>