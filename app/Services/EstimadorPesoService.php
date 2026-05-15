<?php

namespace App\Services;

use App\Strategies\IAlgoritmoEstimacion;
use App\Strategies\ResultadoEstimacion;
use Throwable;

class EstimadorPesoService
{
    private IAlgoritmoEstimacion $algoritmo;

    private ?IAlgoritmoEstimacion $fallback;

    public function __construct(IAlgoritmoEstimacion $algoritmo, ?IAlgoritmoEstimacion $fallback = null)
    {
        $this->algoritmo = $algoritmo;
        $this->fallback = $fallback;
    }

    public function cambiarAlgoritmo(IAlgoritmoEstimacion $algoritmo): void
    {
        $this->algoritmo = $algoritmo;
    }

    public function cambiarFallback(?IAlgoritmoEstimacion $fallback): void
    {
        $this->fallback = $fallback;
    }

    public function estimar(array $datosEntrada): ResultadoEstimacion
    {
        try {
            return $this->algoritmo->ejecutar($datosEntrada);
        } catch (Throwable $exception) {
            return $this->estimarConFallback($datosEntrada, $exception);
        }
    }

    private function estimarConFallback(array $datosEntrada, Throwable $exception): ResultadoEstimacion
    {
        if ($this->fallback === null) {
            throw $exception;
        }

        return $this->fallback->ejecutar(array_merge($datosEntrada, [
            'motivo_fallback' => $exception->getMessage(),
        ]));
    }
}
