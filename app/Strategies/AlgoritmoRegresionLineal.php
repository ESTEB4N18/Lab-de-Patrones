<?php

namespace App\Strategies;

class AlgoritmoRegresionLineal implements IAlgoritmoEstimacion
{
    public function ejecutar(array $datosEntrada): ResultadoEstimacion
    {
        $perimetro = (float) ($datosEntrada['perimetro_toracico'] ?? $datosEntrada['perimetroToracico'] ?? 180);
        $largo = (float) ($datosEntrada['largo_corporal'] ?? 0);
        $edadMeses = (float) ($datosEntrada['edad_meses'] ?? $datosEntrada['edadMeses'] ?? 24);

        $peso = 30 + ($perimetro * 2.5) + ($largo * 0.8) + ($edadMeses * 0.4);

        return new ResultadoEstimacion(
            pesoKg: round($peso, 2),
            confianzaPorcentaje: 88.0,
            metodoUsado: 'Regresion Lineal'
        );
    }
}
