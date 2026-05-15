<?php

namespace App\Observers;

use App\Models\RegistroPeso;

class NotificadorPropietario implements IRegistroPesoObserver
{
    private array $notificaciones = [];

    public function onPesoRegistrado(RegistroPeso $registro): void
    {
        $this->notificaciones[] = [
            'animal_id' => $registro->animal_id,
            'peso' => $registro->peso,
            'fecha_registro' => $registro->fecha_registro,
            'mensaje' => 'Se registro un nuevo peso para el animal.',
        ];
    }

    public function actualizar(RegistroPeso $registro): void
    {
        $this->onPesoRegistrado($registro);
    }

    public function obtenerNotificaciones(): array
    {
        return $this->notificaciones;
    }
}
