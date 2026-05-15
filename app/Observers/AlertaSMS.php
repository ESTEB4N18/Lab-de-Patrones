<?php

namespace App\Observers;

use App\Models\RegistroPeso;

class AlertaSMS implements IRegistroPesoObserver
{
    private array $mensajes = [];

    public function onPesoRegistrado(RegistroPeso $registro): void
    {
        $this->mensajes[] = [
            'animal_id' => $registro->animal_id,
            'mensaje' => "Alerta SMS: nuevo peso registrado de {$registro->peso} kg.",
            'fecha_registro' => $registro->fecha_registro,
        ];
    }

    public function actualizar(RegistroPeso $registro): void
    {
        $this->onPesoRegistrado($registro);
    }

    public function obtenerMensajes(): array
    {
        return $this->mensajes;
    }
}
