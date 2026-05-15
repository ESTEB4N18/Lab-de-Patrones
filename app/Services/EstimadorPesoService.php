<?php

namespace App\Services;

use App\Strategies\AlgoritmoTablaReferencia;
use App\Strategies\IAlgoritmoEstimacion;
use App\Strategies\ResultadoEstimacion;
use Throwable;

class EstimadorPesoService
{
    public function __construct(
        private IAlgoritmoEstimacion $algoritmo,
        private ?IAlgoritmoEstimacion $fallback = null
    ) {
        $this->fallback ??= new AlgoritmoTablaReferencia();
    }

    public function cambiarAlgoritmo(IAlgoritmoEstimacion $algoritmo): void
    {
        $this->algoritmo = $algoritmo;
    }

    public function estimar(array $datosEntrada): ResultadoEstimacion
    {
        try {
            return $this->algoritmo->ejecutar($datosEntrada);
        } catch (Throwable) {
            return $this->fallback->ejecutar($datosEntrada);
        }
    }
}
