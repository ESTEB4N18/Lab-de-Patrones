<?php

namespace App\Models;

class Angus extends Raza
{
    protected $table = 'razas';

    protected $attributes = [
        'nombre' => 'Angus',
        'descripcion' => 'Raza bovina de carne reconocida por su rendimiento y calidad.',
    ];
}
