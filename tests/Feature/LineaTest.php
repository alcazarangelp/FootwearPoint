<?php

namespace Tests\Unit;

use App\Models\Linea;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LineaTest extends TestCase
{
    use RefreshDatabase;

    public function test_puede_crear_una_linea()
    {
        $linea = Linea::create([
            'nombre' => 'TestLinea',
            'descuento' => '15%',
            'activa' => true,
        ]);

        $this->assertDatabaseHas('lineas', [
            'nombre' => 'TestLinea',
        ]);
    }
    
    
}
