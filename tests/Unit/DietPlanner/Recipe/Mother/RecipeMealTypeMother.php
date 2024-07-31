<?php

namespace App\Tests\unit\DietPlanner\Recipe\Mother;

use App\DietPlanner\Recipe\Domain\ValueObject\RecipeMealType;

class RecipeMealTypeMother
{
    public static function create(?string $value = null): RecipeMealType
    {
        $cases = RecipeMealType::cases();

        return ($value === null)
            ? $cases[\array_rand($cases)]
            : RecipeMealType::from($value);
    }
}
