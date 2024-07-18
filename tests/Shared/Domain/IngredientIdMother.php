<?php

namespace App\Tests\Shared\Domain;

use App\DietPlanner\Shared\Domain\ValueObject\IngredientId;

class IngredientIdMother
{
    public static function create(?string $value = null): IngredientId
    {
        return new IngredientId($value ?? UuidMother::create());
    }
}
