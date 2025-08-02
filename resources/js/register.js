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
            contratoInput.addEventListener('blur', validateContrato);

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
            
            contratoInput.addEventListener('input', () => {
                contratoInput.value = contratoInput.value.replace(/\D/g, '');
                
                clearTimeout(debounceTimer);
                debounceTimer = setTimeout(validateContrato, DEBOUNCE_DELAY);
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
