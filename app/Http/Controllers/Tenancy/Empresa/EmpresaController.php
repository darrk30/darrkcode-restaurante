<?php

namespace App\Http\Controllers\Tenancy\Empresa;

use App\Http\Controllers\Controller;
use App\Models\Tenancy\Empresa;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class EmpresaController extends Controller
{
    use AuthorizesRequests;

    public function index()
    {
        $empresa = Empresa::first();
        return view('tenancy.ajustes.empresa.index', compact('empresa'));
    }

    public function store(Request $request)
    {
        $empresa = Empresa::first();
        try {
            $this->authorize('update', [$empresa, $request->only(['ruc'])]);
        } catch (AuthorizationException $e) {
            return redirect()->back()->with('error', 'No puedes modificar el RUC');
        }

        $empresa->razon_social = $request->razon_social ?? $empresa->razon_social;
        $empresa->nombre_comercial = $request->nombre_comercial;
        $empresa->ruc = $request->ruc ?? $empresa->ruc;
        $empresa->email = $request->email;
        $empresa->telefono = $request->telefono;
        $empresa->ubigeo = $request->ubigeo;
        $empresa->direccion = $request->direccion;

        // Guardar logo si subieron uno
        if ($request->hasFile('logo')) {
            $path = $request->file('logo')->store('empresas', 'public');
            $empresa->logo = $path;
        }
        $empresa->save();
        return redirect()->route('empresa.index')->with('success', 'Datos de la empresa actualizados correctamente.');
    }
}
