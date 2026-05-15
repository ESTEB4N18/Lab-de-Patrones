<?php

namespace App\Strategies;

use RuntimeException;

class AlgoritmoYolov8 implements IAlgoritmoEstimacion
{
    public function ejecutar(array $datosEntrada): ResultadoEstimacion
    {
        if (($datosEntrada['servicio_disponible'] ?? true) === false) {
            throw new RuntimeException('Servicio YOLOv8 no disponible.');
        }

        $pesoDirecto = $datosEntrada['peso_estimado'] ?? null;
        $areaCaja = (float) ($datosEntrada['area_bbox'] ?? 0);
        $factorConversion = (float) ($datosEntrada['factor_conversion'] ?? 0.018);

        $peso = $pesoDirecto !== null
            ? (float) $pesoDirecto
            : round($areaCaja * $factorConversion, 2);

        $confianza = $this->normalizarConfianza((float) ($datosEntrada['confianza_porcentaje'] ?? 85.0));

        return new ResultadoEstimacion($peso, $confianza, 'YOLOv8', [
            'area_bbox' => $areaCaja,
            'factor_conversion' => $factorConversion,
        ]);
    }

    private function normalizarConfianza(float $confianza): float
    {
        return max(0.0, min(100.0, $confianza));
    }
}
