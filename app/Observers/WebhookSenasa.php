<?php

namespace App\Observers;

use App\Models\RegistroPeso;

class WebhookSenasa implements IRegistroPesoObserver
{
    private array $eventos = [];

    public function onPesoRegistrado(RegistroPeso $registro): void
    {
        $this->eventos[] = [
            'animal_id' => $registro->animal_id,
            'peso' => $registro->peso,
            'metodo' => $registro->metodo,
            'fecha_registro' => $registro->fecha_registro,
            'evento' => 'registro_peso.creado',
        ];
    }

    public function actualizar(RegistroPeso $registro): void
    {
        $this->onPesoRegistrado($registro);
    }

    public function obtenerEventos(): array
    {
        return $this->eventos;
    }
}
