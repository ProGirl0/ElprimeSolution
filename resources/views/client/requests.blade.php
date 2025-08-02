<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name'))</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="font-sans bg-gray-50">
    <x-navbar />
    
    <main class="min-h-[calc(100vh-160px)]">
        @yield('content')
    </main>
    
    <x-deepbar   />

    @stack('scripts')
</body>
</html>