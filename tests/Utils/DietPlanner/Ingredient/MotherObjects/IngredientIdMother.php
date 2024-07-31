<?php

namespace App\Tests\Utils\DietPlanner\Ingredient\MotherObjects;

use App\DietPlanner\Shared\Domain\ValueObject\IngredientId;

class IngredientIdMother
{
    public static function create(?string $value = null): IngredientId
    {
        return new IngredientId($value ?? \App\Tests\Utils\Shared\MotherObjects\UuidMother::create());
    }
}
