<?php

namespace App\Livewire\Inquilinos;

use App\Models\Tenancy\Empresa;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;

class FormInquilinos extends Component
{
    public $ruc;
    public $razon_social;
    public $nombre_comercial;
    public $direccion;
    public $ubigeo;
    public $departamento;
    public $provincia;
    public $distrito;
    public $correo_contacto;
    public $telefono;

    public $subdominio;
    public $description;
    public $logo;

    public $tenancy_email;
    public $tenancy_password;
    public $tenancy_password_confirmation;

    public function buscarRuc()
    {
        // Limpiar el RUC de cualquier caracter no numérico
        $this->ruc = preg_replace('/\D/', '', $this->ruc);

        // Validar longitud
        if (!$this->ruc || strlen($this->ruc) !== 11) {
            $this->dispatch('alert', type: 'error', message: 'El RUC debe tener exactamente 11 dígitos.');
            return;
        }

        // Validar que empiece con 10 o 20
        if (!preg_match('/^(10|20)/', $this->ruc)) {
            $this->dispatch('alert', type: 'error', message: 'El RUC debe comenzar con 10 o 20.');
            return;
        }

        try {
            $response = Http::get(url("/api/ruc/?ruc={$this->ruc}"));

            if ($response->successful() && $response->json('success') === true) {
                $data = $response->json('data');

                $this->razon_social = $data['razonSocial'] ?? '';
                $this->direccion    = $data['direccion'] ?? '';
                $this->ubigeo       = $data['ubigeo'] ?? '';
                $this->departamento = $data['departamento'] ?? '';
                $this->provincia    = $data['provincia'] ?? '';
                $this->distrito     = $data['distrito'] ?? '';

                $this->dispatch('alert', type: 'success', message: 'Datos cargados correctamente.');
            } else {
                $this->dispatch('alert', type: 'error', message: 'No se encontraron datos para este RUC.');
            }
        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', message: 'Error al consultar el servicio.');
        }
    }

    public function save()
    {
        // Validación
        $this->validate([
            'ruc' => ['required','string','size:11','unique:tenants,tenancy_ruc','regex:/^(10|20)\d{9}$/'],
            'razon_social' => 'required|string|max:255',
            'nombre_comercial' => 'nullable|string|max:255',
            'subdominio' => 'required|string|max:50|unique:tenants,id|alpha_dash',
            'tenancy_email' => 'required|email|max:255|unique:tenants,tenancy_email',
            'tenancy_password' => 'required|string|min:8|confirmed',
            'direccion' => 'nullable|string|max:255',
            'ubigeo' => 'nullable|string|size:6',
            'departamento' => 'nullable|string|max:100',
            'provincia' => 'nullable|string|max:100',
            'distrito' => 'nullable|string|max:100',
            'telefono' => 'nullable|string|max:9',
            'correo_contacto' => 'nullable|email|max:255',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ]);

        try {
            // 1️⃣ Crear tenant en la base central (con transacción)
            $tenant = Tenant::create([
                'id' => $this->subdominio,
                'tenancy_name' => $this->razon_social,
                'tenancy_ruc' => $this->ruc,
                'tenancy_email' => $this->tenancy_email,
                'tenancy_password' => Hash::make($this->tenancy_password),
            ]);
            $tenant->domains()->create([
                'domain' => $this->subdominio . '.' . $this->getBaseDomain(),
            ]);
            //DB::commit(); // Commit solo de la base central

            // 2️⃣ Inicializar tenant
            tenancy()->initialize($tenant);

            try {
                //DB::beginTransaction(); // transacción en la base del tenant

                // Crear usuario
                User::create([
                    'name' => $this->razon_social,
                    'email' => $this->tenancy_email,
                    'password' => Hash::make($this->tenancy_password),
                ]);

                // Guardar logo
                $logoPath = null;
                if ($this->logo) {
                    $filename = Str::slug($this->razon_social) . '-' . time() . '.' . $this->logo->getClientOriginalExtension();
                    $logoPath = $this->logo->storeAs('logos', $filename, 'public');
                }

                // Crear empresa
                Empresa::create([
                    'razon_social' => $this->razon_social,
                    'nombre_comercial' => $this->nombre_comercial ?? null,
                    'ruc' => $this->ruc,
                    'email' => $this->correo_contacto ?? $this->tenancy_email,
                    'telefono' => $this->telefono ?? null,
                    'direccion' => $this->direccion ?? null,
                    'ubigeo' => $this->ubigeo ?? null,
                    'logo' => $logoPath ?? null,
                ]);

            //DB::commit();
            } catch (\Exception $eTenant) {
                //DB::rollBack(); // rollback en tenant
                tenancy()->end();

                // Eliminar tenant creado en la base central para no dejar huérfano
                $tenant->domains()->delete();
                $tenant->delete();

                throw $eTenant;
            }

            tenancy()->end();

            return redirect()->route('tenant.index');
        } catch (\Exception $e) {
            $this->dispatch('alert', type: 'error', message: 'Ocurrió un error al crear la empresa: ' . $e->getMessage());
        }
    }






    /**
     * Devuelve el dominio base de tu sistema, por ejemplo: "tusistema.com"
     */
    private function getBaseDomain()
    {
        return config('app.base_domain', 'darrkcode.test');
    }

    public function render()
    {
        return view('livewire.inquilinos.form-inquilinos');
    }
}
