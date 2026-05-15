<?php

namespace App\Strategies;

class AlgoritmoTablaReferencia implements IAlgoritmoEstimacion
{
    private array $tabla = [
        'angus' => [
            12 => 260.0,
            18 => 360.0,
            24 => 470.0,
            36 => 610.0,
        ],
        'brahman' => [
            12 => 250.0,
            18 => 340.0,
            24 => 430.0,
            36 => 550.0,
        ],
        'nelore' => [
            12 => 240.0,
            18 => 330.0,
            24 => 420.0,
            36 => 540.0,
        ],
        'default' => [
            12 => 230.0,
            18 => 320.0,
            24 => 410.0,
            36 => 520.0,
        ],
    ];

    public function ejecutar(array $datosEntrada): ResultadoEstimacion
    {
        $raza = $this->obtenerRaza($datosEntrada);
        $edadMeses = (int) ($datosEntrada['edad_meses'] ?? 24);
        $referencias = $this->tabla[$raza] ?? $this->tabla['default'];
        $edadReferencia = $this->edadMasCercana($edadMeses, array_keys($referencias));

        return new ResultadoEstimacion($referencias[$edadReferencia], 65.0, 'Tabla de referencia', [
            'raza' => $raza,
            'edad_meses' => $edadMeses,
            'edad_referencia' => $edadReferencia,
        ]);
    }

    private function obtenerRaza(array $datosEntrada): string
    {
        if (isset($datosEntrada['raza'])) {
            return strtolower((string) $datosEntrada['raza']);
        }

        return 'default';
    }

    private function edadMasCercana(int $edad, array $edades): int
    {
        $masCercana = (int) $edades[0];

        foreach ($edades as $edadReferencia) {
            if (abs($edadReferencia - $edad) < abs($masCercana - $edad)) {
                $masCercana = (int) $edadReferencia;
            }
        }

        return $masCercana;
    }
}
