<?php

namespace App\Models;

class Brahman extends Raza
{
    protected $attributes = [
        'nombre' => 'Brahman',
        'descripcion' => 'Raza bovina cebuina de alta adaptacion al tropico.',
        'peso_referencia_min' => 250,
        'peso_referencia_max' => 550,
    ];

    public function getFactorConversion(): float
    {
        return 1.15;
    }
}
