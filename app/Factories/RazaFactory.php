<?php

namespace App\Factories;

use App\Models\Angus;
use App\Models\Brahman;
use App\Models\Nelore;
use App\Models\Raza;
use InvalidArgumentException;

class RazaFactory implements IRazaFactory
{
    private array $razas = [
        'angus' => Angus::class,
        'brahman' => Brahman::class,
        'nelore' => Nelore::class,
    ];

    public function create(string $nombreRaza): Raza
    {
        $clave = strtolower(trim($nombreRaza));

        if (!isset($this->razas[$clave])) {
            throw new InvalidArgumentException("Raza no soportada: {$nombreRaza}");
        }

        $claseRaza = $this->razas[$clave];

        return new $claseRaza();
    }

    public function crear(string $nombreRaza, array $atributos = []): Raza
    {
        $raza = $this->create($nombreRaza);
        $raza->fill($atributos);

        return $raza;
    }
}
