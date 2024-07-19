<?php

namespace App\Tests\DietPlanner\Ingredient\Domain;

use App\DietPlanner\Ingredient\Domain\ValueObject\MeasurementType;

class MeasurementTypeMother
{
    public static function create(?string $value = null): MeasurementType
    {
        $cases = MeasurementType::cases();

        return ($value === null)
            ? $cases[array_rand($cases)]
            : MeasurementType::from($value);
    }
}
