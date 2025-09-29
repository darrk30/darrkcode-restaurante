<?php 

namespace App\Http\Controllers\Tenancy\Productos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tenancy\Producto;
use App\Models\Tenancy\Categoria; // Asumiendo que tienes este modelo

class ProductoController extends Controller
{
    public function index()
    {
        return view('tenancy.productos.productos.index');
    }

    public function create()
    {
        return view('tenancy.productos.productos.create');
    }
}
