<?php

namespace App\Strategies;

class AlgoritmoRegresionLineal implements IAlgoritmoEstimacion
{
    public function ejecutar(array $datosEntrada): ResultadoEstimacion
    {
        $coeficientes = array_merge([
            'intercepto' => -320.0,
            'perimetro_toracico' => 2.4,
            'largo_corporal' => 1.1,
            'edad_meses' => 0.7,
        ], $datosEntrada['coeficientes'] ?? []);

        $perimetroToracico = (float) ($datosEntrada['perimetro_toracico'] ?? 0);
        $largoCorporal = (float) ($datosEntrada['largo_corporal'] ?? 0);
        $edadMeses = (float) ($datosEntrada['edad_meses'] ?? 0);

        $peso = $coeficientes['intercepto']
            + ($coeficientes['perimetro_toracico'] * $perimetroToracico)
            + ($coeficientes['largo_corporal'] * $largoCorporal)
            + ($coeficientes['edad_meses'] * $edadMeses);

        if ($perimetroToracico <= 0 && $largoCorporal <= 0) {
            $peso = (float) ($datosEntrada['peso_actual'] ?? 0);
        }

        return new ResultadoEstimacion(max(0.0, round($peso, 2)), 72.0, 'Regresion lineal', [
            'coeficientes' => $coeficientes,
        ]);
    }
}
