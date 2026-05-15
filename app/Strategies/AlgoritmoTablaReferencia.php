<?php

namespace App\Strategies;

class AlgoritmoTablaReferencia implements IAlgoritmoEstimacion
{
    private array $tabla = [
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
        'angus' => [
            12 => 260.0,
            18 => 360.0,
            24 => 470.0,
            36 => 610.0,
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
        $raza = strtolower((string) ($datosEntrada['raza'] ?? 'default'));
        $edadMeses = (int) ($datosEntrada['edad_meses'] ?? $datosEntrada['edadMeses'] ?? 24);
        $referencias = $this->tabla[$raza] ?? $this->tabla['default'];
        $edadReferencia = $this->edadMasCercana($edadMeses, array_keys($referencias));

        return new ResultadoEstimacion(
            pesoKg: $referencias[$edadReferencia],
            confianzaPorcentaje: 75.0,
            metodoUsado: 'Tabla de referencia'
        );
    }

    private function edadMasCercana(int $edadMeses, array $edades): int
    {
        $edadMasCercana = (int) $edades[0];

        foreach ($edades as $edadReferencia) {
            if (abs($edadReferencia - $edadMeses) < abs($edadMasCercana - $edadMeses)) {
                $edadMasCercana = (int) $edadReferencia;
            }
        }

        return $edadMasCercana;
    }
}
