<?php

namespace App\DietPlanner\Recipe\Domain\Service;

use App\DietPlanner\Recipe\Domain\Recipe;
use App\DietPlanner\Recipe\Domain\RecipeRepositoryInterface;
use App\DietPlanner\Recipe\Domain\ValueObject\PreparationInstructions;
use App\DietPlanner\Recipe\Domain\ValueObject\PreparationTime;
use App\DietPlanner\Recipe\Domain\ValueObject\RecipeDescription;
use App\DietPlanner\Recipe\Domain\ValueObject\RecipeId;
use App\DietPlanner\Recipe\Domain\ValueObject\RecipeIngredientsCollection;
use App\DietPlanner\Recipe\Domain\ValueObject\RecipeMealType;
use App\DietPlanner\Recipe\Domain\ValueObject\RecipeName;
use App\DietPlanner\Recipe\Domain\ValueObject\ServingSize;
use App\Shared\Domain\Event\EventBusInterface;

final readonly class RecipeFactory
{
    public function __construct(
        private RecipeRepositoryInterface $repository,
        private EventBusInterface $eventBus
    ) {}

    public function createRecipe(
        RecipeId $recipeId,
        RecipeName $recipeName,
        RecipeDescription $recipeDescription,
        RecipeMealType $recipeMealType,
        RecipeIngredientsCollection $recipeIngredients,
        PreparationInstructions $preparationInstructions,
        PreparationTime $preparationTime,
        ServingSize $servingSize,
    ): Recipe
    {


        $recipe = Recipe::create(
            $recipeId,
            $recipeName,
            $recipeDescription,
            $recipeMealType,
            $recipeIngredients,
            $preparationInstructions,
            $preparationTime,
            $servingSize
        );


        $this->repository->save($recipe);
        $this->eventBus->publish(...$recipe->callEvents());
    }
}
