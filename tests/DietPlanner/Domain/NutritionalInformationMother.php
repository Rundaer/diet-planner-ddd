<?php

namespace App\Tests\DietPlanner\Domain;

use App\DietPlanner\Ingredient\Domain\ValueObject\IngredientTitle;
use App\DietPlanner\Ingredient\Domain\ValueObject\NutritionalInformation;
use App\Tests\Shared\Domain\IngredientNameMother;
use App\Tests\Shared\Domain\IntegerMother;

class NutritionalInformationMother
{
    public static function create(array $values = []): NutritionalInformation
    {
        $values = array_merge($values, [
            'calories' => IntegerMother::between(10, 100),
            'protein' => IntegerMother::between(10, 30),
            'carbohydrates' => IntegerMother::between(10, 30),
            'fats' => IntegerMother::between(10, 30),
        ]);

        return NutritionalInformation::fromArray($values);
    }
}
