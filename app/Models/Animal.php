<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Animal extends Model
{
    protected $table = 'animales';

    protected $fillable = [
        'nombre',
        'arete',
        'codigo',
        'rancho_id',
        'raza_id',
        'propietario_id',
        'fecha_nacimiento',
        'sexo',
        'peso_actual',
        'altura_cruz',
        'edad_meses',
        'icc',
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
        'peso_actual' => 'float',
        'altura_cruz' => 'float',
        'edad_meses' => 'integer',
        'icc' => 'float',
        'rancho_id' => 'integer',
    ];

    public function raza(): BelongsTo
    {
        return $this->belongsTo(Raza::class, 'raza_id');
    }

    public function registrosPeso(): HasMany
    {
        return $this->hasMany(RegistroPeso::class, 'animal_id');
    }
}
