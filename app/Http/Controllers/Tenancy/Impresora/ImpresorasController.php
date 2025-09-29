<?php

namespace App\Http\Controllers\Tenancy\Impresora;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ImpresorasController extends Controller
{
    public function index()
    {
        return view('tenancy.ajustes.impresoras.index');
    }
}
