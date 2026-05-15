<?php

namespace App\Repositories;

use App\Models\Animal;

class InMemoryAnimalRepository implements IAnimalRepository
{
    private array $animales = [];

    private int $siguienteId = 1;

    public function __construct(iterable $animales = [])
    {
        foreach ($animales as $animal) {
            $this->guardar($animal);
        }
    }

    public function findByArete(string $arete): ?Animal
    {
        foreach ($this->animales as $animal) {
            if ((string) ($animal->arete ?? '') === $arete) {
                return $animal;
            }
        }

        return null;
    }

    public function findAllByRancho(int $ranchoId): array
    {
        return array_values(array_filter(
            $this->animales,
            fn (Animal $animal): bool => (int) ($animal->rancho_id ?? 0) === $ranchoId
        ));
    }

    public function findAll(): array
    {
        return array_values($this->animales);
    }

    public function save(Animal $animal): void
    {
        $this->guardar($animal);
    }

    public function delete(int $id): void
    {
        unset($this->animales[(string) $id]);
    }

    private function guardar(Animal $animal): void
    {
        $id = $animal->getKey();

        if ($id === null) {
            $id = $this->siguienteId++;
            $animal->setAttribute($animal->getKeyName(), $id);
        }

        $this->animales[(string) $id] = $animal;
    }
}
