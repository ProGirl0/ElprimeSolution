<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fatura extends Model
{
    //
    protected $fillable=[
        'id_pedido',
        'metodo_pagamento',
        'status',
        'total',
        'path',

    ];

    protected $table = 'faturas';
    
    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'id_pedido');
    }
    
    public function pagamento()
    {
        return $this->hasOne(Pagamento::class, 'id_fatura');
    }



public function setStatusAttribute($value)
{
    $allowed = ['pendente', 'Em processamento', 'paga'];
    if (!in_array($value, $allowed)) {
        throw new \InvalidArgumentException("Status inválido");
    }
    $this->attributes['status'] = $value;
}
}
