<?php

namespace App\Tests\unit\DietPlanner\Recipe\Mother;

use App\DietPlanner\Recipe\Domain\ValueObject\Quantity;
use App\DietPlanner\Recipe\Domain\ValueObject\RecipeIngredient;
use App\DietPlanner\Shared\Domain\ValueObject\IngredientId;
use App\Tests\Utils\DietPlanner\Ingredient\MotherObjects\IngredientIdMother;

class RecipeIngredientMother
{
    public static function create(
        ?IngredientId $ingredientId = null,
        ?Quantity $quantity = null,
    ): RecipeIngredient {
        return new RecipeIngredient(
            $ingredientId ?? IngredientIdMother::create(),
            $quantity ?? QuantityMother::create()
        );
    }
}
