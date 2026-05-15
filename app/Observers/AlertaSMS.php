<?php

namespace App\Observers;

use App\Models\RegistroPeso;

class AlertaSMS implements IRegistroPesoObserver
{
    public function onPesoRegistrado(RegistroPeso $registro): void
    {
        logger("Enviando SMS por nuevo peso del animal ID: {$registro->animal_id}");
    }
}