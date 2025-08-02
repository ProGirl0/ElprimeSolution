<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Service;
use App\Models\Cliente;
use App\Models\Notification;


class HomeController extends Controller
{
    //

    public function ShowServices (){
        $servicos = Service::with(['categoria' => function($query) {
            $query->select('id', 'nome');
        }])
        ->orderBy('nome')
        ->get(['id', 'nome', 'id_categoria', 'preco', 'descricao']);
    
        return view('client.services', compact('servicos'));
    }


        public function ShowNotifications (){
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
                }
        return view('client.notifications', compact('notificacoes'));
    }
}
