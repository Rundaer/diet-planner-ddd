<?php

namespace App\Tests\unit\DietPlanner\Recipe\Mother;

use App\DietPlanner\Recipe\Application\Command\Create\CreateRecipeCommand;
use App\DietPlanner\Recipe\Domain\ValueObject\RecipeIngredientsCollection;
use App\Tests\Utils\Shared\MotherObjects\RecipeIdMother;

class CreateRecipeCommandMother
{
    public static function create(
        ?string $name = null,
        ?string $description = null,
        ?string $mealType = null,
        ?array $ingredients = null,
        ?string $preparationInstructions = null,
        ?int $preparationTime = null,
        ?int $servingSize = null
    ): CreateRecipeCommand {
        return new CreateRecipeCommand(
            $id ?? RecipeIdMother::create()->value(),
            $name ?? RecipeNameMother::create()->value(),
            $description ?? RecipeDescriptionMother::create()->value(),
            $mealType ?? RecipeMealTypeMother::create()->value,
            $ingredients ?? self::createIngredients(),
            $preparationInstructions ?? PreparationInstructionsMother::create()->value(),
            $preparationTime ?? PreparationTimeMother::create()->minutes(),
            $servingSize ?? ServingSizeMother::create()->value()
        );
    }

    private static function createIngredients(): array
    {
        $recipeIngredients = RecipeIngredientsCollection::create(
            RecipeIngredientMother::create(),
            RecipeIngredientMother::create(),
            RecipeIngredientMother::create(),
        );

        $ingredients = [];
        foreach ($recipeIngredients->getAll() as $recipeIngredient) {
            $ingredients[] = [
                'id' => $recipeIngredient->id->value(),
                'quantity' => $recipeIngredient->quantity->value(),
            ];
        }

        return $ingredients;
    }
}
