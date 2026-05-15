<?php

namespace Tests\Unit;

use App\Services\EstimadorPesoService;
use App\Strategies\AlgoritmoTablaReferencia;
use App\Strategies\AlgoritmoYolov8;
use PHPUnit\Framework\TestCase;

class EstimadorPesoServiceTest extends TestCase
{
    public function test_usa_tabla_de_referencia_cuando_yolov8_no_esta_disponible(): void
    {
        $servicio = new EstimadorPesoService(
            new AlgoritmoYolov8(),
            new AlgoritmoTablaReferencia()
        );

        $resultado = $servicio->estimar([
            'servicio_disponible' => false,
            'raza' => 'brahman',
            'edad_meses' => 24,
        ]);

        $this->assertSame('Tabla de referencia', $resultado->metodoUsado);
        $this->assertSame(430.0, $resultado->pesoKg);
    }
}
