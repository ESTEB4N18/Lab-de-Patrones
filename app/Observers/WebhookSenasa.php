<?php

namespace App\Observers;

use App\Models\RegistroPeso;

class WebhookSenasa implements IRegistroPesoObserver
{
    public function onPesoRegistrado(RegistroPeso $registro): void
    {
        logger("Enviando webhook a SENASA para registro ID: {$registro->id}");
    }
}