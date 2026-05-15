<?php

namespace App\Observers;

use App\Models\RegistroPeso;

class RecalculadorICC implements IRegistroPesoObserver
{
    public function onPesoRegistrado(RegistroPeso $registro): void
    {
        logger("Recalculando ICC para animal ID: {$registro->animal_id}");
    }
}
