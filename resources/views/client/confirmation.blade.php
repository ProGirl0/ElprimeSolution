<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmação de Fatura - Elprime  Solution</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .confirmation-container {
            max-width: 800px;
            margin: 2rem auto;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }
        
        .confirmation-header {
            background: linear-gradient(135deg, #004b8d, #00c476);
            color: white;
            padding: 1.5rem;
            text-align: center;
            font-size: 1.25rem;
            font-weight: 600;
        }
        
        .confirmation-body {
            padding: 2rem;
            text-align: center;
        }
        
        .confirmation-icon {
            font-size: 3rem;
            color: #00c476;
            margin-bottom: 1rem;
        }
        
        .confirmation-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: #004b8d;
        }
        
        .alert-message {
            padding: 1rem;
            border-radius: 0.5rem;
            margin: 1.5rem 0;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }
        
        .alert-success {
            background-color: #f0fdf4;
            color: #166534;
            border: 1px solid #bbf7d0;
        }
        
        .alert-warning {
            background-color: #fffbeb;
            color: #854d0e;
            border: 1px solid #fef08a;
        }
        
        .confirmation-actions {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 2rem;
        }
        
        .confirmation-btn {
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.2s ease;
        }
        
        .btn-primary {
            background-color: #004b8d;
            color: white;
            border: 1px solid #004b8d;
        }
        
        .btn-primary:hover {
            background-color: #003366;
            transform: translateY(-2px);
        }
        
        .btn-secondary {
            background-color: #f3f4f6;
            color: #374151;
            border: 1px solid #e5e7eb;
        }
        
        .btn-secondary:hover {
            background-color: #e5e7eb;
            transform: translateY(-2px);
        }
        
        /* Modal styles */
        .confirmation-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0,0,0,0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }
        
        .modal-content {
            background: white;
            padding: 2rem;
            border-radius: 0.5rem;
            max-width: 500px;
            width: 90%;
            box-shadow: 0 0 20px rgba(0,0,0,0.2);
            animation: modalFadeIn 0.3s ease-out;
        }
        
        @keyframes modalFadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        @media (max-width: 640px) {
            .confirmation-actions {
                flex-direction: column;
            }
            
            .confirmation-btn {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body class="bg-gray-50">
    <!-- Conteúdo Principal -->
    <div class="confirmation-container">
        <div class="confirmation-header">
            Fatura Gerada com Sucesso
        </div>
        
        <div class="confirmation-body">
            <i class="bi bi-check-circle-fill confirmation-icon"></i>
            <h2 class="confirmation-title">Fatura #{{ $invoice->pedido->code }} criada!</h2>
            
            @if($email_status['sent'])
                <div class="alert-message alert-success">
                    <i class="bi bi-envelope-check"></i> Enviada por email com sucesso
                </div>
            @else
                <div class="alert-message alert-warning">
                    <i class="bi bi-envelope-exclamation"></i> {{ $email_status['message'] }}
                </div>
            @endif
            
            <div class="confirmation-actions">
                <a href="/dashboard" class="confirmation-btn btn-secondary">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
                <a href="{{ $invoice_url }}" class="confirmation-btn btn-primary">
                    <i class="bi bi-file-earmark-pdf"></i> Ver Fatura
                </a>
            </div>
        </div>
    </div>

    <!-- Modal de Confirmação Automático -->
    <div id="confirmationModal" class="confirmation-modal">
        <div class="modal-content">
            <i class="bi bi-check-circle-fill confirmation-icon"></i>
            <h2 class="confirmation-title">Fatura #{{ $invoice->pedido->code }} criada!</h2>
            
            @if($email_status['sent'])
                <div class="alert-message alert-success">
                    <i class="bi bi-envelope-check"></i> Enviada por email com sucesso
                </div>
            @else
                <div class="alert-message alert-warning">
                    <i class="bi bi-envelope-exclamation"></i> {{ $email_status['message'] }}
                </div>
            @endif
            
            <div class="confirmation-actions">
                <a href="/dashboard" class="confirmation-btn btn-secondary">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
                <a href="{{ $invoice_url }}" class="confirmation-btn btn-primary">
                    <i class="bi bi-file-earmark-pdf"></i> Ver Fatura
                </a>
            </div>
        </div>
    </div>

    <script>
        // Mostrar modal automaticamente
        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('confirmationModal');
            modal.style.display = 'flex';
            
            // Fechar modal ao clicar fora
            modal.addEventListener('click', function(e) {
                if (e.target === modal) {
                    modal.style.display = 'none';
                }
            });
            
            // Fechar automaticamente após 8 segundos
            setTimeout(() => {
                modal.style.display = 'none';
            }, 8000);
        });
    </script>
</body>
</html>