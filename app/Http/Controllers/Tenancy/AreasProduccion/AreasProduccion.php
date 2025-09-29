<?php

namespace App\Http\Controllers\Tenancy\AreasProduccion;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AreasProduccion extends Controller
{
    public function index(){
        return view('tenancy.ajustes.areasProduccion.index');
    }
}
