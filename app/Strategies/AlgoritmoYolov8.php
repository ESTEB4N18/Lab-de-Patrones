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

        $pesoKg = (float) ($datosEntrada['peso_estimado'] ?? 482.5);
        $confianza = (float) ($datosEntrada['confianza_porcentaje'] ?? 96.8);

        return new ResultadoEstimacion(
            pesoKg: $pesoKg,
            confianzaPorcentaje: $confianza,
            metodoUsado: 'YOLOv8'
        );
    }
}
