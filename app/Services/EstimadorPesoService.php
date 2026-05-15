<?php

namespace App\Services;

use App\Strategies\IAlgoritmoEstimacion;
use App\Strategies\ResultadoEstimacion;

class EstimadorPesoService
{
    public function __construct(
        private IAlgoritmoEstimacion $algoritmo
    ) {}

    public function estimar(array $datosEntrada): ResultadoEstimacion
    {
        return $this->algoritmo->ejecutar($datosEntrada);
    }
}