<?php

namespace App\Models;

class Brahman extends Raza
{
    public function __construct()
    {
        parent::__construct('Brahman');
    }

    public function getFactorConversion(): float
    {
        return 1.15;
    }
}
