<?php

namespace App\Http\Controllers\Tenancy\Pisos;

use App\Http\Controllers\Controller;

class PisosController extends Controller
{
    public function index()
    {
        return view('tenancy.ajustes.pisos.index');
    }
}
