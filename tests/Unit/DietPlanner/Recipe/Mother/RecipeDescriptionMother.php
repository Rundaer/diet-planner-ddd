<?php

namespace App\Tests\unit\DietPlanner\Recipe\Mother;

use App\DietPlanner\Recipe\Domain\ValueObject\RecipeDescription;
use App\Tests\Utils\Shared\MotherObjects\WordMother;

class RecipeDescriptionMother
{
    public static function create(?string $value = null): RecipeDescription
    {
        return new RecipeDescription($value ?? WordMother::createText());
    }
}
