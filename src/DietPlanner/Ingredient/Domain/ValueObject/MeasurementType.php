<?php

namespace App\DietPlanner\Ingredient\Domain\ValueObject;

use App\DietPlanner\Ingredient\Domain\Exception\InvalidMeasurementType;

enum MeasurementType: string
{
    case GRAM = 'gram';
    case KILOGRAM = 'kilogram';
    case LITER = 'liter';
    case MILLILITER = 'milliliter';
    case CUP = 'cup';
    case TABLESPOON = 'tablespoon';
    case TEASPOON = 'teaspoon';

    public static function fromName(string $name): ?self
    {
        foreach (self::cases() as $type) {
            if ($name === $type->value) {
                return $type;
            }
        }

        throw new InvalidMeasurementType($name);
    }
}
