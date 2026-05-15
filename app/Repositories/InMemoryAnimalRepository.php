<?php

namespace App\Repositories;

use App\Models\Animal;

class InMemoryAnimalRepository implements IAnimalRepository
{
    private array $animales = [];

    public function findByArete(string $arete): ?Animal
    {
        foreach ($this->animales as $animal) {
            if ($animal->arete === $arete) {
                return $animal;
            }
        }

        return null;
    }

    public function findAllByRancho(int $ranchoId): array
    {
        return array_values(array_filter(
            $this->animales,
            fn (Animal $animal) => $animal->rancho_id === $ranchoId
        ));
    }

    public function save(Animal $animal): void
    {
        $this->animales[$animal->id ?? count($this->animales) + 1] = $animal;
    }

    public function delete(int $id): void
    {
        unset($this->animales[$id]);
    }
}