<?php

namespace App\Tests\Utils\DietPlanner\IngredientCategory\MotherObjects;

use App\DietPlanner\Shared\Domain\ValueObject\IngredientCategoryId;

class IngredientCategoryIdMother
{
    public static function create(?string $value = null): IngredientCategoryId
    {
        return new IngredientCategoryId($value ?? \App\Tests\Utils\Shared\MotherObjects\UuidMother::create());
    }
}
