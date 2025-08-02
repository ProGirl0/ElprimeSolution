<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Service;

class IndexController extends Controller
{
    //
    public function ShowIndex(){
    
    return view('welcome');
    }

    public function showCategoria ($id){
        $categoria=Categoria::with('services')->findOrFail($id);
        return view ('client.categoria', compact('categoria'));
    }

    public function ShowService($id){
        $service=Service::findOrFail($id);
    return view ('client.service', compact('service'));
    }
}
