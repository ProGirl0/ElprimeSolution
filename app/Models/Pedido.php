<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    //
     protected $table = 'pedidos';

     protected $fillable=[
        'code',
        'id_user',
        'id_service',

     ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'id_usuario');
    }
    
    public function service()
    {
        return $this->belongsTo(Service::class, 'id_service');
    }
    
    public function fatura()
    {
        return $this->hasMany(Fatura::class, 'id_pedido');
    }
}   
