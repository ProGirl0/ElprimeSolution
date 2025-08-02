<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;
use App\Models\Fatura;
use App\Models\Pagamento;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
class MeuPedidoController extends Controller
{
    //
    public function historico(){

        $pedidos = Pedido::with(['fatura.pagamento' => function($query) {
           $query->orderBy('created_at', 'desc');
        }, 'service'])
        ->where('id_user', auth()->id())
        ->orderBy('created_at', 'desc')
        ->paginate(10); 
           return view('client.meusPedidos', compact('pedidos'));
    }

    // No PedidoController
public function search(Request $request)
{
    $pedidos = Pedido::with(['fatura', 'service'])
                ->when($request->search, function($query, $search) {
                    return $query->where('code', 'like', "%$search%")
                                ->orWhereHas('service', function($q) use ($search) {
                                    $q->where('nome', 'like', "%$search%");
                                });
                })
                ->when($request->status, function($query, $status) {
                    return $query->whereHas('fatura', function($q) use ($status) {
                        $q->where('status', $status);
                    });
                })
                ->where('id_user', auth()->id())
                ->orderBy('created_at', 'desc')
                ->paginate(10);
    
    return view('client.meusPedidos', compact('pedidos'));
}

public function pagar(Request $request)
{
    $request->validate([
        'fatura_id' => 'required|exists:faturas,id',

        'comprovante' => 'required|file|mimes:pdf,jpg,jpeg,png|max:5120'
    ]);

    try {
        DB::beginTransaction();

        // 1. Busca a fatura com tratamento de exceção
        $fatura = Fatura::lockForUpdate()->findOrFail($request->fatura_id);
        
        // 2. Verifica se já não está paga
        if ($fatura->status === 'Paga') {
            return back()->with('error', 'Esta fatura já foi paga anteriormente!');
        }

        // 3. Armazena o comprovante
        $path = $request->file('comprovante')->store(
            'comprovantes/'.date('Y/m'), 
            'public'
        );

        // 4. Cria o registro de pagamento
        Pagamento::create([
            'id_fatura' => $fatura->id,
            'metodo_pagamento' => $request->metodo_pagamento,
            'path' => $path,
            'status' => 'Pendente'
        ]);

        // 5. ATUALIZAÇÃO CORRIGIDA DA FATURA
        $atualizado = $fatura->update([
            'status' => 'Em processamento',
            'updated_at' => now()
        ]);

        if (!$atualizado) {
            throw new \Exception("Falha ao atualizar status da fatura");
        }

        DB::commit();

        return back()->with('success', 'Comprovante enviado com sucesso! Status atualizado.');

    } catch (\Exception $e) {
        DB::rollBack();
        Log::error("Erro no pagamento: ".$e->getMessage());
        
        return back()
               ->with('error', 'Erro ao processar pagamento: '.$e->getMessage())
               ->withInput();
    }
}
}
