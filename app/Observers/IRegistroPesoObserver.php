<?php

namespace App\Observers;

use App\Models\RegistroPeso;

interface IRegistroPesoObserver
{
    public function onPesoRegistrado(RegistroPeso $registro): void;
}