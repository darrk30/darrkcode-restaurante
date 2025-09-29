<?php

namespace App\Http\Controllers\Tenancy\Categorias;

use App\Http\Controllers\Controller;
use App\Models\Tenancy\Categoria;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{
    public function index(){
        return view('tenancy.productos.categorias.index');
    }
}
