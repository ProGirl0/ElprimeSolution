<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Elprime Solution | Login</title>
    <link rel="shortcut icon" href="/img/logomarca.png" type="image/x-icon">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
        
        .gradient-bg {
            background: linear-gradient(-45deg, #004b8d, #00c476, #002a52, #00a566);
            background-size: 400% 400%;
            animation: gradientShift 12s ease infinite;
        }
        
        .glass-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.18);
        }
        
        .card-enter {
            animation: cardEnter 0.6s cubic-bezier(0.22, 1, 0.36, 1) forwards;
        }
        
        @keyframes cardEnter {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }
        
        .input-focus-effect:focus {
            box-shadow: 0 0 0 4px rgba(0, 196, 118, 0.2);
        }
        
        .btn-hover-effect:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px -10px rgba(0, 196, 118, 0.4);
        }
        
        .input-icon {
            left: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: #00c476;
        }
        
        .input-with-icon {
            padding-left: 48px !important;
        }
    </style>
</head>
<body class="min-h-screen gradient-bg flex items-center justify-center p-4 font-sans">
    <div class="w-full max-w-md card-enter">
        <!-- Session Status -->
        @if(session('status'))
            <div class="mb-6 p-4 bg-white bg-opacity-90 text-green-700 rounded-lg shadow-md backdrop-blur-sm animate-pulse">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="glass-card p-8 rounded-2xl shadow-2xl relative">
            <!-- Logo da Empresa - Substitua pelo seu logo -->
            <div class="flex justify-center mb-8">
                <div class="bg-opacity-100 p-3 rounded-full shadow-lg -mt-16">
                    <img src="/img/logomarca.png" class="h-20" alt="Logotipo">
                </div>
            </div>

            @csrf

            <div class="text-center mb-8">
                <h1 class="text-3xl font-bold text-white mb-2">Welcome Back</h1>
                <p class="text-white text-opacity-80">Sign in to your account</p>
            </div>

            <!-- Email Address -->
            <div class="mb-6">
                <label for="email" class="sr-only">Email</label>
                <div class="relative">
                    <div class="absolute input-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                        </svg>
                    </div>
                    <input 
                        id="email" 
                        name="email" 
                        type="email" 
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="username"
                        placeholder="your@email.com"
                        class="w-full px-4 py-3 border border-white border-opacity-30 bg-white bg-opacity-20 text-white rounded-xl focus:border-white input-focus-effect transition-all duration-300 placeholder-white placeholder-opacity-60 input-with-icon"
                    >
                </div>
                @error('email')
                    <p class="mt-2 text-red-300 text-sm flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-6">
                <label for="password" class="sr-only">Password</label>
                <div class="relative">
                    <div class="absolute input-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                    </div>
                    <input 
                        id="password" 
                        name="password" 
                        type="password" 
                        required
                        autocomplete="current-password"
                        placeholder="••••••••"
                        class="w-full px-4 py-3 border border-white border-opacity-30 bg-white bg-opacity-20 text-white rounded-xl focus:border-white input-focus-effect transition-all duration-300 placeholder-white placeholder-opacity-60 input-with-icon"
                    >
                    <button type="button" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-white text-opacity-60 hover:text-opacity-100" onclick="togglePasswordVisibility()">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                    </button>
                </div>
                @error('password')
                    <p class="mt-2 text-red-300 text-sm flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Remember Me & Forgot Password -->
            <div class="flex items-center justify-between mb-8">
                <div class="flex items-center">
                    <input 
                        id="remember_me" 
                        name="remember" 
                        type="checkbox" 
                        class="h-5 w-5 border border-white border-opacity-30 bg-white bg-opacity-20 rounded focus:ring-offset-transparent focus:ring-white"
                    >
                    <label for="remember_me" class="ml-2 text-white text-opacity-80 text-sm select-none">Remember me</label>
                </div>

                @if (Route::has('password.request'))
                    <a 
                        href="{{ route('password.request') }}" 
                        class="text-sm text-white text-opacity-80 hover:text-opacity-100 transition-colors"
                    >
                        Forgot password?
                    </a>
                @endif
            </div>

            <!-- Login Button -->
            <button 
                type="submit" 
                class="w-full bg-white text-[#004b8d] font-medium px-6 py-4 rounded-xl transition-all duration-300 btn-hover-effect flex items-center justify-center"
            >
                <span>Sign In</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                </svg>
            </button>

            <!-- Sign Up Link -->
            <div class="mt-6 text-center text-sm text-white text-opacity-80">
                Don't have an account? 
                <a href="{{ route('register') }}" class="text-white hover:text-opacity-100 font-medium transition-colors">
                    Sign up
                </a>
            </div>
        </form>
    </div>

    <script>
        // Toggle password visibility
        function togglePasswordVisibility() {
            const passwordInput = document.getElementById('password');
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
        }

        // Animate inputs on focus for better UX
        document.querySelectorAll('input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('input-focused');
            });
            input.addEventListener('blur', function() {
                this.parentElement.classList.remove('input-focused');
            });
        });
    </script>
</body>
</html>