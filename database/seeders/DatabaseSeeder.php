<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        \App\Models\Servicio::create([
            'id' => 1,
             'nombre' => 'Falta de Combustible',
             'descripcion' => '...',
        ]);
        \App\Models\Servicio::create([
            'id' => 2,
             'nombre' => 'Problema de Energia',
             'descripcion' => '...',
        ]);
        \App\Models\Servicio::create([
            'id' => 3,
             'nombre' => 'Falta de aire o Pinchazo',
             'descripcion' => '...',
        ]);
        \App\Models\Servicio::create([
            'id' => 4,
             'nombre' => 'Otros',
             'descripcion' => '...',
        ]);


        \App\Models\Cobro::create([
            'id' => 1,
             'nombre' => 'QR',
        ]);
        \App\Models\Cobro::create([
            'id' => 2,
             'nombre' => 'Efectivo',
        ]);
    }
}
