<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

abstract class Raza extends Model
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

    public function animales(): HasMany
    {
        return $this->hasMany(Animal::class, 'raza_id');
    }
}
