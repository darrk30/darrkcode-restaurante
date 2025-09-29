<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RucDniController extends Controller
{
    private $token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImtyaXZlcmFyb2phczQ0QGdtYWlsLmNvbSJ9.vdnwHkb3e0nx9VtKCN7U-FGdMzQdn_K9M_I_hdkzG-Q';

    /**
     * Consulta un RUC y devuelve los datos
     */
    public function getRuc(Request $request)
    {
        $request->validate([
            'ruc' => 'required|digits:11',
        ]);

        $ruc = $request->ruc;
        $url = "https://dniruc.apisperu.com/api/v1/ruc/{$ruc}?token={$this->token}";

        $response = Http::get($url);

        if ($response->failed()) {
            return response()->json([
                'success' => false,
                'message' => 'No se pudo consultar el RUC'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $response->json()
        ]);
    }

    /**
     * Consulta un DNI y devuelve los datos
     */
    public function getDni(Request $request)
    {
        $request->validate([
            'dni' => 'required|digits:8',
        ]);

        $dni = $request->dni;
        $url = "https://dniruc.apisperu.com/api/v1/dni/{$dni}?token={$this->token}";

        $response = Http::get($url);

        if ($response->failed()) {
            return response()->json([
                'success' => false,
                'message' => 'No se pudo consultar el DNI'
            ], 400);
        }

        return response()->json([
            'success' => true,
            'data' => $response->json()
        ]);
    }
}
