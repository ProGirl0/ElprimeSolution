<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    // 
    protected $fillable=[
        'nome',
        'id_categoria',
        'descricao',
        'preco',
    ];


    public function categoria(){
    return $this->belongsTo(Categoria::class, 'id_categoria');
    }
}
