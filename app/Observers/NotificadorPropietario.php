<?php

namespace App\Observers;

use App\Models\RegistroPeso;

class NotificadorPropietario implements IRegistroPesoObserver
{
    public function onPesoRegistrado(RegistroPeso $registro): void
    {
        logger("Notificando al propietario del animal ID: {$registro->animal_id}");
    }
}
