<?php

namespace App\Strategies;

readonly class ResultadoEstimacion
{
    public function __construct(
        public float $pesoKg,
        public float $confianzaPorcentaje,
        public string $metodoUsado
    ) {}
}
