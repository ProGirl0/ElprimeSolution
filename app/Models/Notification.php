<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    //
    protected $fillable=[
        'id_cliente',
        'tipo',
        'descricao',
        'observacao',
        'remitente',
    ];

        public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente');
    }

}
