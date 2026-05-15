<?php

namespace App\Strategies;

class AlgoritmoYolov8 implements IAlgoritmoEstimacion
{
    public function ejecutar(array $datosEntrada): ResultadoEstimacion
    {
        // Simulación de llamada HTTP al servicio YOLOv8
        return new ResultadoEstimacion(
            pesoKg: 482.5,
            confianzaPorcentaje: 96.8,
            metodoUsado: 'YOLOv8'
        );
    }
}
