<?php

namespace App\Http\Traits;

trait UnitConversionTrait
{

    public function celsiusToFahrenheit($value)
    {
        $fahrenheit = ($value * 1.8) + 32;
        return $fahrenheit;
    }
}
