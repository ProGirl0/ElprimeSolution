<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\FaturaController;
use App\Http\Controllers\MeuPedidoController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;


use App\Models\Pedido;
use App\Models\Pagamento;
use App\Models\Cliente;
use App\Models\Notification;
use App\Models\Service;
use App\Models\Categoria;
// Rotas Públicas
Route::get('/', [IndexController::class, 'ShowIndex'])->name('welcome');
Route::get('/categories/{id}', [IndexController::class, 'showCategoria'])->name('categories.show');

Route::get('/about', function () {
    return view('about');
});
Route::get('/team', function () {
    return view('team');
});
Route::get('/products', function () {
    return view('products');
});
Route::get('/galeria', function () {
    return view('galeria');
});
Route::get('/blog', function () {
    return view('blog');
});
Route::get('/contacts', function () {
    return view('contacts');
});
Route::get('/services', [HomeController::class, 'ShowServices'])->name('services.index');
// Validação de BI (protegida por auth)
Route::post('/validar-bi', [RegisteredUserController::class, 'validarBi'])
     ->name('validation.bi');

// Rotas Autenticadas
Route::middleware(['auth', 'verified'])->group(function () {
    // Perfil
    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    // Dashboard



Route::get('/dashboard', function () {
    // Obter pedidos do usuário
    $pedidos = Pedido::with(['fatura' => function($query) {
            $query->orderBy('created_at', 'desc');
        }, 'service'])
        ->where('id_user', auth()->id())
        ->orderBy('created_at', 'desc')
        ->limit(3)
        ->get();

    // Obter cliente associado
    $cliente = Cliente::where('id_usuario', auth()->id())->first();
    
    if (!$cliente) {
        $notificacoes = collect();
        $pagamentos = collect();
    } else {
        // Obter notificações do cliente
        $notificacoes = Notification::where('id_cliente', $cliente->id)
            ->with(['cliente' => function($query) {
                $query->select('id');
            }])
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get([
                'id',
                'tipo',
                'descricao',
                'id_cliente',
                'created_at',
            ]);

        // Obter pagamentos do cliente
        $pagamentos = Pagamento::whereHas('fatura.pedido', function($query) use ($cliente) {
                $query->where('id_user', $cliente->id_usuario);
            })
            ->with(['fatura' => function($query) {
                $query->select('id', 'id_pedido');
            }])
            ->orderBy('created_at', 'desc')
            ->limit(3)
            ->get()
            ->map(function($pagamento) {
                $pathArray = null;
                
                if ($pagamento->path) {
                    $extension = pathinfo($pagamento->path, PATHINFO_EXTENSION);
                    $pathArray = [
                        'url' => Storage::url($pagamento->path),
                        'tipo' => $extension === 'pdf' ? 'pdf' : 'imagem'
                    ];
                }

                return [
                    'id' => $pagamento->id,
                    'id_fatura' => $pagamento->id_fatura,
                    'status' => $pagamento->status,
                    'path' => $pathArray,
                    'data' => $pagamento->created_at->format('d/m/Y H:i')
                ];
            });
    }

    $servicos = Service::with(['categoria' => function($query) {
        $query->select('id', 'nome');
    }])
    ->orderBy('nome')
    ->get(['id', 'nome', 'id_categoria', 'preco', 'descricao']);


    return view('client.dashboard', compact('pedidos', 'notificacoes', 'pagamentos','servicos'));
})->name('dashboard');

    // Serviços

    Route::get('/service/{id}', [IndexController::class, 'ShowService'])->name('services.show');
    
    
    // Notificações
    Route::get('/notifications', [HomeController::class, 'ShowNotifications'])->name('notifications.index');

    // Processo de Pagamento
    Route::prefix('services/{service}')->group(function () {
        // Seleção de Pagamento
        Route::get('/select-payment', [FaturaController::class, 'selectPaymentForm'])
             ->name('payments.select');
        
        Route::post('/process-payment', [FaturaController::class, 'selectPayment'])
             ->name('payments.process');
        
        // Finalização (sem middleware)
        Route::get('/finalize', [FaturaController::class, 'showInvoice'])
             ->name('invoices.preview');
        
        Route::post('/confirm', [FaturaController::class, 'processInvoice'])
             ->name('invoices.process');
    });


    // Faturas
    Route::prefix('invoices')->group(function () {
        Route::get('/{invoice}', [FaturaController::class, 'show'])
            ->name('invoices.show');
        Route::get('/{invoice}/download', [FaturaController::class, 'download'])
            ->name('invoices.download');
            
            
    });

    Route::get('/invoice/confirmation', [FaturaController::class, 'showConfirmation'])
     ->name('invoice.confirmation')
     ->middleware(['auth', 'verified']);

     Route::get('/pedidos/historico', [MeuPedidoController::class, 'historico'])->name('pedidos.historico');
     Route::get('/faturas/{id}/download', [FaturaController::class, 'download'])->name('faturas.download');
// Pesquisa de pedidos
Route::get('/pedidos/search', [MeuPedidoController::class, 'search'])->name('pedidos.search');

// Pagamento de fatura
Route::post('/faturas/pagar', [MeuPedidoController::class, 'pagar'])->name('faturas.pagar');

Route::get('/comprovante/{id}', function ($id) {
    $pagamento = App\Models\Pagamento::with('fatura')->findOrFail($id);
    
    return view('comprovante', [
        'pagamento' => $pagamento,
        'fatura' => $pagamento->fatura
    ]);
})->middleware('auth')->name('comprovante.show');
});
require __DIR__.'/auth.php';