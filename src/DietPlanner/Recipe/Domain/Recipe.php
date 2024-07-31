<?php

namespace App\DietPlanner\Recipe\Domain;

use App\DietPlanner\Recipe\Domain\ValueObject\PreparationInstructions;
use App\DietPlanner\Recipe\Domain\ValueObject\PreparationTime;
use App\DietPlanner\Recipe\Domain\ValueObject\RecipeDescription;
use App\DietPlanner\Recipe\Domain\ValueObject\RecipeId;
use App\DietPlanner\Recipe\Domain\ValueObject\RecipeIngredientsCollection;
use App\DietPlanner\Recipe\Domain\ValueObject\RecipeMealType;
use App\DietPlanner\Recipe\Domain\ValueObject\RecipeName;
use App\DietPlanner\Recipe\Domain\ValueObject\ServingSize;
use App\Shared\Domain\AggregateRoot;

class Recipe extends AggregateRoot
{
    private function __construct(
        public readonly RecipeId $id,
        public readonly RecipeName $name,
        public readonly RecipeDescription $description,
        public readonly RecipeMealType $type,
        public readonly RecipeIngredientsCollection $ingredients,
        public readonly PreparationInstructions $preparationInstructions,
        public readonly PreparationTime $preparationTime,
        public readonly ServingSize $servingSize
    ) {}

    public static function create(
        RecipeId $id,
        RecipeName $name,
        RecipeDescription $description,
        RecipeMealType $type,
        RecipeIngredientsCollection $ingredients,
        PreparationInstructions $preparationInstructions,
        PreparationTime $preparationTime,
        ServingSize $servingSize
    ): self {
        return new self($id, $name, $description, $type, $ingredients, $preparationInstructions, $preparationTime, $servingSize);
    }
}
