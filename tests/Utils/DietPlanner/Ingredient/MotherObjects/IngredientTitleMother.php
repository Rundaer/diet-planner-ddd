<?php

namespace App\Tests\Utils\DietPlanner\Ingredient\MotherObjects;

use App\DietPlanner\Ingredient\Domain\ValueObject\IngredientTitle;

class IngredientTitleMother
{
    public static function create(?string $value = null): IngredientTitle
    {
        return new IngredientTitle($value ?? IngredientNameMother::create());
    }
}
