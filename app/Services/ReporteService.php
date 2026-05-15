<?php

namespace App\Services;

use App\Repositories\IAnimalRepository;

class ReporteService
{
    public function __construct(
        private IAnimalRepository $animalRepository
    ) {}

    public function obtenerAnimalesPorRancho(int $ranchoId): array
    {
        return $this->animalRepository->findAllByRancho($ranchoId);
    }
}