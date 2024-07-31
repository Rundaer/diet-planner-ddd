<?php

namespace App\Tests\Utils\DietPlanner\Ingredient\MotherObjects;

use App\DietPlanner\Ingredient\Domain\Event\IngredientCreated;
use App\DietPlanner\Ingredient\Domain\Ingredient;
use App\DietPlanner\Shared\Domain\ValueObject\IngredientId;

class IngredientCreatedEventMother
{
    public static function create(
        ?IngredientId $ingredientId = null,
    ): IngredientCreated {
        return IngredientCreated::create(
            $ingredientId ?? IngredientIdMother::create()
        );
    }

    public static function fromIngredient(Ingredient $ingredient): IngredientCreated
    {
        return self::create($ingredient->ingredientId);
    }
}
