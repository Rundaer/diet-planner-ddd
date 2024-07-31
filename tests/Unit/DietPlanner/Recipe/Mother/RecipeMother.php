<?php

namespace App\Tests\unit\DietPlanner\Recipe\Mother;

use App\DietPlanner\Recipe\Application\Command\Create\CreateRecipeCommand;
use App\DietPlanner\Recipe\Domain\Recipe;
use App\DietPlanner\Recipe\Domain\ValueObject\PreparationInstructions;
use App\DietPlanner\Recipe\Domain\ValueObject\PreparationTime;
use App\DietPlanner\Recipe\Domain\ValueObject\RecipeDescription;
use App\DietPlanner\Recipe\Domain\ValueObject\RecipeId;
use App\DietPlanner\Recipe\Domain\ValueObject\RecipeIngredientsCollection;
use App\DietPlanner\Recipe\Domain\ValueObject\RecipeMealType;
use App\DietPlanner\Recipe\Domain\ValueObject\RecipeName;
use App\DietPlanner\Recipe\Domain\ValueObject\ServingSize;
use App\Tests\Utils\Shared\MotherObjects\RecipeIdMother;

class RecipeMother
{
    public static function create(
        RecipeId $id = null,
        RecipeName $name = null,
        RecipeDescription $description = null,
        RecipeMealType $type = null,
        RecipeIngredientsCollection $ingredients = null,
        PreparationInstructions $preparationInstructions = null,
        PreparationTime $preparationTime = null,
        ServingSize $servingSize = null,
    ): Recipe {
        return Recipe::create(
            $id ?? RecipeIdMother::create(),
            $name ?? RecipeNameMother::create(),
            $description ?? RecipeDescriptionMother::create(),
            $type ?? RecipeMealTypeMother::create(),
            $ingredients ?? RecipeIngredientCollectionMother::create(),
            $preparationInstructions ?? PreparationInstructionsMother::create(),
            $preparationTime ?? PreparationTimeMother::create(),
            $servingSize ?? ServingSizeMother::create()
        );
    }

    public static function fromRequest(CreateRecipeCommand $command): Recipe
    {
        return Recipe::create(
            RecipeIdMother::create($command->id),
            RecipeNameMother::create($command->name),
            RecipeDescriptionMother::create($command->description),
            RecipeMealTypeMother::create($command->mealType),
            RecipeIngredientCollectionMother::fromArray($command->ingredients),
            PreparationInstructionsMother::create($command->preparationInstructions),
            PreparationTimeMother::create($command->preparationTime),
            ServingSizeMother::create($command->servingSize)
        );
    }
}
