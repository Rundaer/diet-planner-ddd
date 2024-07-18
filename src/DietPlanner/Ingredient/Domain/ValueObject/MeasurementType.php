<?php

namespace App\DietPlanner\Ingredient\Domain\ValueObject;

enum MeasurementType: string
{
    case GRAM = 'gram';
    case KILOGRAM = 'kilogram';
    case LITER = 'liter';
    case MILLILITER = 'milliliter';
    case CUP = 'cup';
    case TABLESPOON = 'tablespoon';
    case TEASPOON = 'teaspoon';
}
