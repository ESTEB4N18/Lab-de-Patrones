<?php

namespace App\Factories;

use App\Models\Angus;
use App\Models\Brahman;
use App\Models\Nelore;
use App\Models\Raza;
use InvalidArgumentException;

class RazaFactory implements IRazaFactory
{
    private array $mapa = [
        'brahman' => Brahman::class,
        'nelore' => Nelore::class,
        'angus' => Angus::class,
    ];

    public function create(string $nombreRaza): Raza
    {
        $clave = strtolower(trim($nombreRaza));

        if (!isset($this->mapa[$clave])) {
            throw new InvalidArgumentException("La raza '{$nombreRaza}' no esta soportada.");
        }

        $clase = $this->mapa[$clave];

        return new $clase();
    }
}
