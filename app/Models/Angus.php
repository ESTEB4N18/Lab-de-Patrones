<?php

namespace App\Models;

class Angus extends Raza
{
    protected $attributes = [
        'nombre' => 'Angus',
        'descripcion' => 'Raza bovina de carne reconocida por su rendimiento y calidad.',
        'peso_referencia_min' => 260,
        'peso_referencia_max' => 610,
    ];

    public function getFactorConversion(): float
    {
        return 1.20;
    }
}
