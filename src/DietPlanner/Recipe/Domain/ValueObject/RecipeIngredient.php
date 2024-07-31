<?php

namespace App\DietPlanner\Recipe\Domain\ValueObject;

use App\DietPlanner\Shared\Domain\ValueObject\IngredientId;

readonly class RecipeIngredient
{
    public function __construct(
        public IngredientId $id,
        public Quantity $quantity
    ) {
    }
}
