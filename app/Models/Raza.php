<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Raza extends Model
{
    protected $table = 'razas';

    protected $fillable = [
        'nombre',
        'descripcion',
        'peso_referencia_min',
        'peso_referencia_max',
    ];

    protected $casts = [
        'peso_referencia_min' => 'float',
        'peso_referencia_max' => 'float',
    ];

    public function getNombre(): string
    {
        return (string) $this->nombre;
    }

    public function getDescripcion(): string
    {
        return (string) $this->descripcion;
    }

    public function animales(): HasMany
    {
        return $this->hasMany(Animal::class, 'raza_id');
    }

    public function getFactorConversion(): float
    {
        return 1.0;
    }
}
