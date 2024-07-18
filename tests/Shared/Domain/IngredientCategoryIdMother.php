<?php

namespace App\Tests\Shared\Domain;

use App\DietPlanner\Shared\Domain\ValueObject\IngredientCategoryId;

class IngredientCategoryIdMother
{
    public static function create(?string $value = null): IngredientCategoryId
    {
        return new IngredientCategoryId($value ?? UuidMother::create());
    }
}
