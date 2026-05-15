<?php

namespace App\Observers;

use App\Models\RegistroPeso;

class RecalculadorICC implements IRegistroPesoObserver
{
    public function onPesoRegistrado(RegistroPeso $registro): void
    {
        $animal = $registro->animal;

        if ($animal === null) {
            return;
        }

        $altura = (float) ($animal->altura_cruz ?? 0);

        if ($altura <= 0) {
            $animal->peso_actual = (float) $registro->peso;
            $animal->save();

            return;
        }

        $animal->peso_actual = (float) $registro->peso;
        $animal->icc = round($animal->peso_actual / ($altura * $altura), 2);
        $animal->save();
    }

    public function actualizar(RegistroPeso $registro): void
    {
        $this->onPesoRegistrado($registro);
    }
}
