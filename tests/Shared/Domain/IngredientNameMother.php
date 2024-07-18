<?php

namespace App\Tests\Shared\Domain;

class IngredientNameMother
{
    private static array $ingredients = [
        'apple', 'banana', 'carrot', 'garlic', 'onion', 'tomato', 'potato',
        'chicken', 'beef', 'fish', 'rice', 'pasta', 'flour', 'sugar', 'salt',
        'pepper', 'olive oil', 'milk', 'cheese', 'egg'
        // Add more ingredients as needed
    ];

    public static function create(): string
    {
        $faker = MotherCreator::random();
        return $faker->randomElement(self::$ingredients);
    }

    public static function createMany(int $count): array
    {
        $faker = MotherCreator::random();
        return $faker->randomElements(self::$ingredients, $count);
    }
}
