<?php

namespace App\Strategies;

class ResultadoEstimacion
{
    public readonly float $pesoKg;

    public readonly float $confianzaPorcentaje;

    public readonly string $metodoUsado;

    public readonly array $detalles;

    public function __construct(float $pesoKg, float $confianzaPorcentaje, string $metodoUsado, array $detalles = [])
    {
        $this->pesoKg = $pesoKg;
        $this->confianzaPorcentaje = max(0.0, min(100.0, $confianzaPorcentaje));
        $this->metodoUsado = $metodoUsado;
        $this->detalles = $detalles;
    }

    public function pesoEstimado(): float
    {
        return $this->pesoKg;
    }

    public function confianza(): float
    {
        return $this->confianzaPorcentaje;
    }

    public function algoritmo(): string
    {
        return $this->metodoUsado;
    }

    public function detalles(): array
    {
        return $this->detalles;
    }

    public function toArray(): array
    {
        return [
            'peso_kg' => $this->pesoKg,
            'confianza_porcentaje' => $this->confianzaPorcentaje,
            'metodo_usado' => $this->metodoUsado,
            'detalles' => $this->detalles,
        ];
    }
}
