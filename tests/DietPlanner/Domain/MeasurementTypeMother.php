<?php

namespace App\Tests\DietPlanner\Domain;

use App\DietPlanner\Ingredient\Domain\ValueObject\IngredientTitle;
use App\DietPlanner\Ingredient\Domain\ValueObject\MeasurementType;
use App\Tests\Shared\Domain\IngredientNameMother;

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
