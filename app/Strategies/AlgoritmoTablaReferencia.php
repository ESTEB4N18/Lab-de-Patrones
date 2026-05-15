<?php

namespace App\Strategies;

class AlgoritmoTablaReferencia implements IAlgoritmoEstimacion
{
    public function ejecutar(array $datosEntrada): ResultadoEstimacion
    {
        $edadMeses = $datosEntrada['edadMeses'] ?? 24;

        $peso = match (true) {
            $edadMeses < 12 => 180,
            $edadMeses < 24 => 320,
            default => 450,
        };

        return new ResultadoEstimacion(
            pesoKg: $peso,
            confianzaPorcentaje: 75.0,
            metodoUsado: 'Tabla de Referencia'
        );
    }
}