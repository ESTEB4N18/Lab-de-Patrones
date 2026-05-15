<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RegistroPeso extends Model
{
    protected $table = 'registros_peso';

    protected $fillable = [
        'animal_id',
        'peso',
        'metodo',
        'fecha_registro',
        'confianza',
        'datos',
    ];

    protected $casts = [
        'peso' => 'float',
        'fecha_registro' => 'datetime',
        'confianza' => 'float',
        'datos' => 'array',
    ];

    public function animal(): BelongsTo
    {
        return $this->belongsTo(Animal::class, 'animal_id');
    }
}
