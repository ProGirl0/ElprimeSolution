<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pagamento extends Model
{
    //
    protected $fillable=[
        'id_fatura',
        'path',
        'status',
    ];
    protected $table = 'pagamentos';
    
    public function fatura()
    {
        return $this->belongsTo(Fatura::class, 'id_fatura');
    }

    // No model Pagamento
public function scopeDoUsuario($query, $userId)
{
    return $query->whereHas('fatura.pedido', function($q) use ($userId) {
        $q->where('user_id', $userId);
    });
}
}
