<?php

namespace App\Observers;

use App\Models\RegistroPeso;

class RegistroPesoSubject
{
    private array $observadores = [];

    public function suscribir(IRegistroPesoObserver $observador): void
    {
        $this->observadores[spl_object_hash($observador)] = $observador;
    }

    public function desuscribir(IRegistroPesoObserver $observador): void
    {
        unset($this->observadores[spl_object_hash($observador)]);
    }

    public function registrarPeso(RegistroPeso $registro): RegistroPeso
    {
        $registro->save();
        $this->notificar($registro);

        return $registro;
    }

    private function notificar(RegistroPeso $registro): void
    {
        foreach ($this->observadores as $observador) {
            $observador->onPesoRegistrado($registro);
        }
    }

    public function adjuntar(IRegistroPesoObserver $observador): void
    {
        $this->suscribir($observador);
    }

    public function separar(IRegistroPesoObserver $observador): void
    {
        $this->desuscribir($observador);
    }
}
