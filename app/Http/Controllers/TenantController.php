<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TenantController extends Controller
{

    protected $baseDomain;

    public function __construct()
    {
        $this->baseDomain = parse_url(config('app.url'), PHP_URL_HOST);
    }

    private function getBaseDomain()
    {
        return parse_url(config('app.url'), PHP_URL_HOST);
    }

    public function index()
    {
        $tenants = Tenant::all();
        return view('inquilinos.index', compact('tenants'));
    }

    public function create()
    {
        return view('inquilinos.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'id'       => 'required|string|unique:tenants,id',
            'tenancy_name'     => 'required|string',
            'tenancy_ruc'      => 'required|string|size:11|unique:tenants,tenancy_ruc',
            'tenancy_email'    => 'required|email|unique:tenants,tenancy_email',
            'tenancy_password' => 'required|string|min:8',
        ]);

        // Crear el tenant en la BD central
        $tenant = Tenant::create($request->all());

        // Crear dominio
        $tenant->domains()->create([
            'domain' => $request->id . '.' . $this->getBaseDomain(),
        ]);

        // Inicializar contexto tenant para crear el usuario en su propia BD
        tenancy()->initialize($tenant);

        User::create([
            'name'     => $request->tenancy_name,
            'email'    => $request->tenancy_email,
            'password' => Hash::make($request->tenancy_password),
        ]);

        tenancy()->end();

        return redirect()->route('tenant.index');
    }


    public function show(Tenant $tenant) {}

    public function edit(Tenant $tenant)
    {
        return view('inquilinos.edit', compact('tenant'));
    }

    public function update(Request $request, Tenant $tenant)
    {
        $request->validate([
            'id' => 'required|unique:tenants,id,' . $tenant->id,
        ]);
        $tenant->update(['id' => $request->get('id'),]);
        $tenant->domains()->update([
            'domain' => $request->get('id') . '.' . $this->getBaseDomain()
        ]);
        return redirect()->route('tenant.index');
    }

    public function destroy(Tenant $tenant)
    {
        $tenant->delete();
        return redirect()->route('tenant.index');
    }
}
