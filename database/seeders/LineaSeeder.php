<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Linea;

class LineaSeeder extends Seeder
{
    public function run()
    {
        $lineas = [
            [
                'nombre' => 'Andrea',
                'descuento' => '25%',
                'activa' => true,
            ],
            [
                'nombre' => 'Mega',
                'descuento' => '20%',
                'activa' => true,
            ],
            [
                'nombre' => 'Impuls',
                'descuento' => '20%',
                'activa' => true,
            ],
            [
                'nombre' => 'Dankriz',
                'descuento' => '20%',
                'activa' => true,
            ],
            [
                'nombre' => 'Cklass',
                'descuento' => '20%',
                'activa' => true,
            ],
        ];

        foreach ($lineas as $linea) {
            Linea::firstOrCreate(['nombre' => $linea['nombre']], $linea);
        }
    }
}