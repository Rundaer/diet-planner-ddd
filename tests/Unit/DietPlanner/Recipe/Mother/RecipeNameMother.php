<?php

namespace App\Tests\unit\DietPlanner\Recipe\Mother;

use App\DietPlanner\Recipe\Domain\ValueObject\RecipeName;
use App\Tests\Utils\Shared\MotherObjects\WordMother;

class RecipeNameMother
{
    public static function create(?string $value = null): RecipeName
    {
        return new RecipeName($value ?? WordMother::create());
    }
}
