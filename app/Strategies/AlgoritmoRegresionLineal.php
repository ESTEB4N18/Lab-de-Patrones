<?php

namespace App\Strategies;

class AlgoritmoRegresionLineal implements IAlgoritmoEstimacion
{
    public function ejecutar(array $datosEntrada): ResultadoEstimacion
    {
        $perimetro = $datosEntrada['perimetroToracico'] ?? 180;

        $peso = ($perimetro * 2.5) + 30;

        return new ResultadoEstimacion(
            pesoKg: $peso,
            confianzaPorcentaje: 88.0,
            metodoUsado: 'Regresión Lineal'
        );
    }
}