<?php

namespace App\Strategies;

interface IAlgoritmoEstimacion
{
    public function ejecutar(array $datosEntrada): ResultadoEstimacion;
}