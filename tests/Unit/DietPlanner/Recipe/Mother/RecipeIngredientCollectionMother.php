<?php

namespace App\Tests\unit\DietPlanner\Recipe\Mother;

use App\DietPlanner\Recipe\Domain\ValueObject\RecipeIngredientsCollection;
use App\Tests\Utils\DietPlanner\Ingredient\MotherObjects\IngredientIdMother;

class RecipeIngredientCollectionMother
{
    public static function create(int $amount = 3): RecipeIngredientsCollection
    {
        $recipeIngredients = [];
        for ($i = 0; $i < $amount; $i++) {
            $recipeIngredients[] = RecipeIngredientMother::create();
        }

        return RecipeIngredientsCollection::create(...$recipeIngredients);
    }

    public static function fromArray(array $ingredients): RecipeIngredientsCollection
    {
        return RecipeIngredientsCollection::create(...\array_map(function (array $element) {
            return RecipeIngredientMother::create(
                IngredientIdMother::create($element['id']),
                QuantityMother::create($element['quantity'])
            );
        }, $ingredients));
    }
}
