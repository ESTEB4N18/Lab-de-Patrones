<?php

namespace App\Models;

abstract class Raza
{
    protected string $nombre;

    public function __construct(string $nombre)
    {
        $this->nombre = $nombre;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    abstract public function getFactorConversion(): float;
}