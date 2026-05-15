<?php

namespace App\Observers;

use App\Models\RegistroPeso;

class RegistroPesoSubject
{
    private array $observadores = [];

    public function suscribir(IRegistroPesoObserver $observer): void
    {
        $this->observadores[] = $observer;
    }

    public function desuscribir(IRegistroPesoObserver $observer): void
    {
        $this->observadores = array_filter(
            $this->observadores,
            fn ($actual) => $actual !== $observer
        );
    }

    public function registrarPeso(RegistroPeso $registro): void
    {
        $registro->save();

        $this->notificar($registro);
    }

    private function notificar(RegistroPeso $registro): void
    {
        foreach ($this->observadores as $observer) {
            $observer->onPesoRegistrado($registro);
        }
    }
}