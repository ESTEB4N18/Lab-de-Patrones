<?php

namespace App\Services;

use App\Models\Animal;
use App\Repositories\IAnimalRepository;

class ReporteService
{
    private IAnimalRepository $animales;

    public function __construct(IAnimalRepository $animales)
    {
        $this->animales = $animales;
    }

    public function generarResumen(): array
    {
        return $this->resumir($this->animales->findAll());
    }

    public function generarResumenPorRancho(int $ranchoId): array
    {
        return $this->resumir($this->animales->findAllByRancho($ranchoId));
    }

    public function buscarFichaPorArete(string $arete): ?array
    {
        $animal = $this->animales->findByArete($arete);

        return $animal === null ? null : $this->generarFicha($animal);
    }

    private function resumir(array $animales): array
    {
        $total = 0;
        $pesoAcumulado = 0.0;
        $porRaza = [];

        foreach ($animales as $animal) {
            $total++;
            $pesoAcumulado += (float) ($animal->peso_actual ?? 0);

            $raza = $this->nombreRaza($animal);
            $porRaza[$raza] = ($porRaza[$raza] ?? 0) + 1;
        }

        return [
            'total_animales' => $total,
            'peso_promedio' => $total > 0 ? round($pesoAcumulado / $total, 2) : 0.0,
            'por_raza' => $porRaza,
        ];
    }

    public function generarFicha(Animal $animal): array
    {
        return [
            'id' => $animal->getKey(),
            'codigo' => $animal->codigo,
            'nombre' => $animal->nombre,
            'raza' => $this->nombreRaza($animal),
            'peso_actual' => $animal->peso_actual,
            'icc' => $animal->icc,
        ];
    }

    private function nombreRaza(Animal $animal): string
    {
        if (isset($animal->raza) && isset($animal->raza->nombre)) {
            return (string) $animal->raza->nombre;
        }

        return 'Sin raza';
    }
}
