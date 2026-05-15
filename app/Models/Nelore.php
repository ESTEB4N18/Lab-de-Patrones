<?php

namespace App\Models;

class Nelore extends Raza
{
    public function __construct()
    {
        parent::__construct('Nelore');
    }

    public function getFactorConversion(): float
    {
        return 1.10;
    }
}
