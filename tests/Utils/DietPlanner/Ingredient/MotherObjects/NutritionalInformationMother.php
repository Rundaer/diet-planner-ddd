<?php

namespace App\Tests\Utils\DietPlanner\Ingredient\MotherObjects;

use App\DietPlanner\Ingredient\Domain\ValueObject\NutritionalInformation;
use App\Tests\Utils\Shared\MotherObjects\IntegerMother;

class NutritionalInformationMother
{
    public static function create(array $values = []): NutritionalInformation
    {
        $defaultValues = [
            'calories' => IntegerMother::between(10, 100),
            'protein' => IntegerMother::between(10, 30),
            'carbohydrates' => IntegerMother::between(10, 30),
            'fats' => IntegerMother::between(10, 30),
        ];

        $mergedValues = \array_merge($defaultValues, $values);

        return NutritionalInformation::fromArray($mergedValues);
    }
}
