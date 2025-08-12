<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Elprime Solution | Cadastro</title>
           <link rel="stylesheet" href="/build/assets/app.css">
    <link rel="shortcut icon" href="/img/logomarca.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <script src="/build/assets/app2.js"></script>

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
        
        .validation-icon {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
        }
        
        .password-toggle {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: rgba(255, 255, 255, 0.7);
        }
        
        .password-toggle:hover {
            color: white;
        }
        
        .btn-disabled {
            opacity: 0.7;
            cursor: not-allowed;
        }
    </style>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="min-h-screen gradient-bg flex items-center justify-center p-4 font-sans">
    <div class="w-full max-w-md card-enter">
        
           
        <form method="POST" action="{{ route('register') }}" id="registerForm" class="glass-card p-8 rounded-2xl shadow-2xl space-y-4">
        @csrf

        <!-- Logo da Empresa -->
            <div class="flex justify-center mb-8">
                <div class="bg-opacity-100 p-3 rounded-full shadow-lg -mt-16">
                    <img src="/img/logomarca.png" class="h-20" alt="Logotipo">
                </div>
            </div>    
        @csrf
               
            <!-- Nome Completo -->
            <div class="relative">
                <div class="absolute input-icon">
                    <i class="fas fa-user"></i>
                </div>
                <input type="text" id="name" name="name" placeholder="Nome completo"
                    class="w-full px-4 py-3 border border-white border-opacity-30 bg-white bg-opacity-20 text-white rounded-xl focus:border-white input-focus-effect transition-all duration-300 placeholder-white placeholder-opacity-60 input-with-icon">
                @error('name')
                    <p class="mt-2 text-red-300 text-sm flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Email -->
            <div class="relative">
                <div class="absolute input-icon">
                    <i class="fas fa-envelope"></i>
                </div>
                <input type="email" id="email" name="email" placeholder="Email"
                    class="w-full px-4 py-3 border border-white border-opacity-30 bg-white bg-opacity-20 text-white rounded-xl focus:border-white input-focus-effect transition-all duration-300 placeholder-white placeholder-opacity-60 input-with-icon">
                <div id="emailLoading" class="validation-icon hidden">
                    <i class="fas fa-spinner fa-spin text-white text-opacity-70"></i>
                </div>
                <div id="emailSuccess" class="validation-icon hidden">
                    <i class="fas fa-check-circle text-green-300"></i>
                </div>
                <div id="emailError" class="validation-icon hidden">
                    <i class="fas fa-times-circle text-red-300"></i>
                </div>
                <p id="emailMessage" class="mt-2 text-sm hidden"></p>
                @error('email')
                    <p class="mt-2 text-red-300 text-sm flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Número do BI -->
            <div class="relative">
                <div class="absolute input-icon">
                    <i class="fas fa-id-card"></i>
                </div>
                <input type="text" id="bi" name="bi" placeholder="Número de BI"
                    class="w-full px-4 py-3 border border-white border-opacity-30 bg-white bg-opacity-20 text-white rounded-xl focus:border-white input-focus-effect transition-all duration-300 placeholder-white placeholder-opacity-60 input-with-icon">
                <div id="biLoading" class="validation-icon hidden">
                    <i class="fas fa-spinner fa-spin text-white text-opacity-70"></i>
                </div>
                <div id="biSuccess" class="validation-icon hidden">
                    <i class="fas fa-check-circle text-green-300"></i>
                </div>
                <div id="biError" class="validation-icon hidden">
                    <i class="fas fa-times-circle text-red-300"></i>
                </div>
                <p id="biMessage" class="mt-2 text-sm hidden"></p>
                @error('bi')
                    <p class="mt-2 text-red-300 text-sm flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Contato -->
            <div class="relative">
                <div class="absolute input-icon">
                    <i class="fas fa-phone"></i>
                </div>
                <input type="text" id="contacto" name="telefone" placeholder="Telefone"
                    class="w-full px-4 py-3 border border-white border-opacity-30 bg-white bg-opacity-20 text-white rounded-xl focus:border-white input-focus-effect transition-all duration-300 placeholder-white placeholder-opacity-60 input-with-icon">
                <div id="contactoLoading" class="validation-icon hidden">
                    <i class="fas fa-spinner fa-spin text-white text-opacity-70"></i>
                </div>
                <div id="contactoSuccess" class="validation-icon hidden">
                    <i class="fas fa-check-circle text-green-300"></i>
                </div>
                <div id="contactoError" class="validation-icon hidden">
                    <i class="fas fa-times-circle text-red-300"></i>
                </div>
                <p id="contactoMessage" class="mt-2 text-sm hidden"></p>
                @error('telefone')
                    <p class="mt-2 text-red-300 text-sm flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Senha -->
            <div class="relative">
                <div class="absolute input-icon">
                    <i class="fas fa-lock"></i>
                </div>
                <input type="password" id="password" name="password" placeholder="Senha"
                    class="w-full px-4 py-3 border border-white border-opacity-30 bg-white bg-opacity-20 text-white rounded-xl focus:border-white input-focus-effect transition-all duration-300 placeholder-white placeholder-opacity-60 input-with-icon">
                <button type="button" class="password-toggle" onclick="togglePasswordVisibility('password')">
                    <i class="far fa-eye"></i>
                </button>
                @error('password')
                    <p class="mt-2 text-red-300 text-sm flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Confirmar Senha -->
            <div class="relative">
                <div class="absolute input-icon">
                    <i class="fas fa-lock"></i>
                </div>
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirmar senha"
                    class="w-full px-4 py-3 border border-white border-opacity-30 bg-white bg-opacity-20 text-white rounded-xl focus:border-white input-focus-effect transition-all duration-300 placeholder-white placeholder-opacity-60 input-with-icon">
                <button type="button" class="password-toggle" onclick="togglePasswordVisibility('password_confirmation')">
                    <i class="far fa-eye"></i>
                </button>
                @error('password_confirmation')
                    <p class="mt-2 text-red-300 text-sm flex items-center">
                        <i class="fas fa-exclamation-circle mr-1"></i>
                        {{ $message }}
                    </p>
                @enderror
            </div>

            <!-- Campo oculto para tipo de usuário -->
            <input type="hidden" name="tipo_de_usuario" value="Cliente">
            
            <!-- Botão de Cadastro -->
            <button type="submit" id="submitButton"
                class="w-full bg-white text-[#004b8d] font-medium px-6 py-3 rounded-xl transition-all duration-300 btn-hover-effect flex items-center justify-center">
                <span id="buttonText">Cadastrar</span>
                <span id="buttonSpinner" class="hidden ml-2">
                    <i class="fas fa-spinner fa-spin"></i>
                </span>
            </button>

        </form>
    </div>

    <script>
        window.biValidationRoute = "{{ route('validation.bi') }}";
        window.csrfToken = "{{ csrf_token() }}";
        
        // Toggle password visibility
        function togglePasswordVisibility(fieldId) {
            const input = document.getElementById(fieldId);
            const icon = input.nextElementSibling.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.replace('fa-eye', 'fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.replace('fa-eye-slash', 'fa-eye');
            }
        }
        document.addEventListener('DOMContentLoaded', function() {
    // Configurações
    const DEBOUNCE_DELAY = 500;
    const PHONE_REGEX = /^9[234571]\d{7}$/;
    
    // Elementos
    const biInput = document.getElementById('bi');
    const biLoading = document.getElementById('biLoading');
    const biSuccess = document.getElementById('biSuccess');
    const biError = document.getElementById('biError');
    const biMessage = document.getElementById('biMessage');
    
    const emailInput = document.getElementById('email');
    const emailLoading = document.getElementById('emailLoading');
    const emailSuccess = document.getElementById('emailSuccess');
    const emailError = document.getElementById('emailError');
    const emailMessage = document.getElementById('emailMessage');
    
    const contactoInput = document.getElementById('contacto');
    const contactoLoading = document.getElementById('contactoLoading');
    const contactoSuccess = document.getElementById('contactoSuccess');
    const contactoError = document.getElementById('contactoError');
    const contactoMessage = document.getElementById('contactoMessage');
    
    const contratoInput = document.getElementById('contrato');
    const contratoLoading = document.getElementById('contratoLoading');
    const contratoSuccess = document.getElementById('contratoSuccess');
    const contratoError = document.getElementById('contratoError');
    const contratoMessage = document.getElementById('contratoMessage');
    
    const nameInput = document.getElementById('name');
    const registerForm = document.getElementById('registerForm');
    const submitButton = document.getElementById('submitButton');
    
    // Estado
    let biValid = false;
    let emailValid = false;
    let contactoValid = false;
    let contratoValid = false;
    let isRequestPending = false;

    // Mostrar mensagem de status
    const showMessage = (element, message, type = 'error') => {
        element.textContent = message;
        element.className = 'text-sm mt-1';
        element.classList.add(type === 'success' ? 'text-green-600' : 'text-red-600');
        element.classList.remove('hidden');
    };

    // Validação do telefone
    const validatePhone = () => {
        const phone = contactoInput.value.trim();
        
        // Remove tudo que não for dígito
        contactoInput.value = phone.replace(/\D/g, '');
        
        if (phone.length > 0 && phone.length !== 9) {
            showMessage(contactoMessage, 'O telefone deve ter 9 dígitos', 'error');
            contactoError.classList.remove('hidden');
            contactoSuccess.classList.add('hidden');
            contactoValid = false;
            return;
        }
        
        if (phone.length === 9 && !PHONE_REGEX.test(phone)) {
            showMessage(contactoMessage, 'Telefone inválido. Deve começar com 9 seguido de 2,3,4,5,7 ou 1', 'error');
            contactoError.classList.remove('hidden');
            contactoSuccess.classList.add('hidden');
            contactoValid = false;
            return;
        }
        
        if (phone.length === 9 && PHONE_REGEX.test(phone)) {
            // Validação de unicidade será feita no servidor
            contactoValid = true;
            contactoSuccess.classList.remove('hidden');
            contactoError.classList.add('hidden');
            contactoMessage.classList.add('hidden');
        } else {
            contactoMessage.classList.add('hidden');
        }
    };

    // Validação do Email
    const validateEmail = () => {
        const email = emailInput.value.trim();
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        
        if (email.length > 0 && !emailRegex.test(email)) {
            showMessage(emailMessage, 'Email inválido', 'error');
            emailError.classList.remove('hidden');
            emailSuccess.classList.add('hidden');
            emailValid = false;
            return;
        }
        
        if (email.length > 0 && emailRegex.test(email)) {
            // Validação de unicidade será feita no servidor
            emailValid = true;
            emailSuccess.classList.remove('hidden');
            emailError.classList.add('hidden');
            emailMessage.classList.add('hidden');
        } else {
            emailMessage.classList.add('hidden');
        }
    };

    // Validação do BI via API
    const validateBI = async () => {
        if (!biInput.value.trim() || isRequestPending) return;
        
        biValid = false;
        biLoading.classList.remove('hidden');
        biSuccess.classList.add('hidden');
        biError.classList.add('hidden');
        biMessage.classList.add('hidden');
        isRequestPending = true;
        
        try {
            const response = await fetch(window.biValidationRoute, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': window.csrfToken, // Ou use o meta tag como você já está fazendo
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ bi: biInput.value.trim() })
            });

            const contentType = response.headers.get('content-type');
            if (!contentType || !contentType.includes('application/json')) {
                throw new Error('Resposta não é JSON');
            }

            const data = await response.json();
            
            if (!response.ok) {
                throw new Error(data.message || 'Erro ao validar BI');
            }
            
            if (data.error === false) {
                biValid = true;
                biSuccess.classList.remove('hidden');
                showMessage(biMessage, 'BI válido', 'success');
                
                if (data.name && !nameInput.value.trim()) {
                    nameInput.value = data.name;
                    nameInput.removeAttribute('readonly');
                }
            } else {
                throw new Error(data.message || 'BI inválido');
            }
        } catch (error) {
            showMessage(biMessage, error.message || 'Erro ao validar BI', 'error');
            biError.classList.remove('hidden');
            
            if (error.message.includes('419')) {
                window.location.reload();
            }
        } finally {
            biLoading.classList.add('hidden');
            isRequestPending = false;
        }
    };

    // Função para alternar visibilidade da senha
    window.togglePasswordVisibility = (fieldId) => {
        const field = document.getElementById(fieldId);
        const toggleButton = field.nextElementSibling;
        
        if (field.type === 'password') {
            field.type = 'text';
            toggleButton.innerHTML = '<i class="far fa-eye-slash"></i>';
        } else {
            field.type = 'password';
            toggleButton.innerHTML = '<i class="far fa-eye"></i>';
        }
    };

    // Eventos
    biInput.addEventListener('blur', validateBI);
    emailInput.addEventListener('blur', validateEmail);
    contactoInput.addEventListener('blur', validatePhone);


    // Validação durante a digitação (com debounce)
    let debounceTimer;
    
    biInput.addEventListener('input', () => {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(validateBI, DEBOUNCE_DELAY);
    });
    
    emailInput.addEventListener('input', () => {
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(validateEmail, DEBOUNCE_DELAY);
    });
    
    contactoInput.addEventListener('input', () => {
        let phone = contactoInput.value.replace(/\D/g, '');
        if (phone.length > 9) phone = phone.substring(0, 9);
        contactoInput.value = phone;
        
        clearTimeout(debounceTimer);
        debounceTimer = setTimeout(validatePhone, DEBOUNCE_DELAY);
    });

    // Validação antes do envio
    registerForm.addEventListener('submit', function(e) {
        let isValid = true;
        
        if (!biValid) {
            isValid = false;
            showMessage(biMessage, 'Por favor, valide seu número de BI', 'error');
            validateBI();
        }
        
        if (!emailValid) {
            isValid = false;
            showMessage(emailMessage, 'Por favor, insira um email válido', 'error');
        }
        
        if (!contactoValid) {
            isValid = false;
            showMessage(contactoMessage, 'Por favor, insira um telefone válido', 'error');
        }
        
        if (!contratoValid) {
            isValid = false;
            showMessage(contratoMessage, 'Por favor, insira um contrato válido', 'error');
        }
        
        if (!isValid) {
            e.preventDefault();
            
            const firstError = document.querySelector('.text-red-600:not(.hidden)');
            if (firstError) {
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        } else {
            submitButton.disabled = true;
            document.getElementById('buttonText').classList.add('hidden');
            document.getElementById('buttonSpinner').classList.remove('hidden');
        }
    });
});

    </script>
</body>
</html>