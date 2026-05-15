<?php

namespace App\Repositories;

use App\Models\Animal;

class EloquentAnimalRepository implements IAnimalRepository
{
    public function findByArete(string $arete): ?Animal
    {
        return Animal::query()
            ->where('arete', $arete)
            ->first();
    }

    public function findAllByRancho(int $ranchoId): array
    {
        return Animal::query()
            ->where('rancho_id', $ranchoId)
            ->with('registrosPeso')
            ->get()
            ->all();
    }

    public function findAll(): array
    {
        return Animal::query()->get()->all();
    }

    public function save(Animal $animal): void
    {
        $animal->save();
    }

    public function delete(int $id): void
    {
        Animal::query()->whereKey($id)->delete();
    }
}
