<?php

namespace App\Tests\Utils\Shared\MotherObjects;

use App\DietPlanner\Recipe\Domain\ValueObject\RecipeId;

class RecipeIdMother
{
    public static function create(?string $value = null): RecipeId
    {
        return new RecipeId($value ?? UuidMother::create());
    }
}
