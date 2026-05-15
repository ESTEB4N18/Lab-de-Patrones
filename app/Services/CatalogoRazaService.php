<?php

namespace App\Services;

use App\Factories\IRazaFactory;
use App\Models\Raza;

class CatalogoRazaService
{
    public function __construct(private readonly IRazaFactory $razaFactory)
    {
    }

    public function crearRazaBase(string $nombreRaza): Raza
    {
        return $this->razaFactory->create($nombreRaza);
    }

    public function crearCatalogoBase(): array
    {
        return [
            $this->razaFactory->create('brahman'),
            $this->razaFactory->create('nelore'),
            $this->razaFactory->create('angus'),
        ];
    }
}
