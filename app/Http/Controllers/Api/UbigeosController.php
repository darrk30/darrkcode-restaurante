<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Departamento;
use App\Models\Distrito;
use App\Models\Provincia;
use Illuminate\Http\Request;

class UbigeosController extends Controller
{
    public function departamentos(Request $request)
    {
        $query = Departamento::query();
        if ($request->has('search')) {
            $query->where('nombre', 'like', "%{$request->search}%");
        }
        return response()->json($query->select('id', 'nombre', 'codigo')->get());
    }

    public function provincias(Request $request)
    {
        $request->validate(['departamento_codigo' => 'required|exists:departamentos,codigo']);

        $query = Provincia::where('codigo', 'like', $request->departamento_codigo . '%');

        if ($request->has('search')) {
            $query->where('nombre', 'like', "%{$request->search}%");
        }

        return response()->json($query->select('id', 'nombre', 'codigo')->get());
    }

    public function distritos(Request $request)
    {
        $request->validate(['provincia_codigo' => 'required|exists:provincias,codigo']);

        $query = Distrito::where('codigo', 'like', $request->provincia_codigo . '%');

        if ($request->has('search')) {
            $query->where('nombre', 'like', "%{$request->search}%");
        }

        return response()->json($query->select('id', 'nombre', 'codigo')->get());
    }
}
