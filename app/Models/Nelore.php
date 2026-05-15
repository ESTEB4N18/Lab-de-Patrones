<?php

namespace App\Models;

class Nelore extends Raza
{
    protected $attributes = [
        'nombre' => 'Nelore',
        'descripcion' => 'Raza bovina cebuina usada frecuentemente en sistemas de carne.',
        'peso_referencia_min' => 240,
        'peso_referencia_max' => 540,
    ];

    public function getFactorConversion(): float
    {
        return 1.10;
    }
}
