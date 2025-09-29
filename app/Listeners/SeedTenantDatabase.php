<?php

namespace App\Listeners;

use Stancl\Tenancy\Events\TenantCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Artisan;

class SeedTenantDatabase
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TenantCreated $event): void
    {
        tenancy()->initialize($event->tenant);

        Artisan::call('db:seed', [
            '--class' => 'Database\\Seeders\\TenantDatabaseSeeder',
            '--force' => true
        ]);

        tenancy()->end();
    }
}
