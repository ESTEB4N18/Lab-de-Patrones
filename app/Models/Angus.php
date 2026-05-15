<?php

namespace App\Models;

class Angus extends Raza
{
    public function __construct()
    {
        parent::__construct('Angus');
    }

    public function getFactorConversion(): float
    {
        return 1.20;
    }
}