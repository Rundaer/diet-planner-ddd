<?php

namespace App\DietPlanner\Recipe\Application\Command\Create;

use App\DietPlanner\Ingredient\Domain\IngredientRepositoryInterface;
use App\DietPlanner\Recipe\Domain\Recipe;
use App\DietPlanner\Recipe\Domain\RecipeRepositoryInterface;
use App\DietPlanner\Recipe\Domain\Service\RecipeFactory;
use App\DietPlanner\Recipe\Domain\ValueObject\PreparationInstructions;
use App\DietPlanner\Recipe\Domain\ValueObject\PreparationTime;
use App\DietPlanner\Recipe\Domain\ValueObject\Quantity;
use App\DietPlanner\Recipe\Domain\ValueObject\RecipeDescription;
use App\DietPlanner\Recipe\Domain\ValueObject\RecipeId;
use App\DietPlanner\Recipe\Domain\ValueObject\RecipeIngredient;
use App\DietPlanner\Recipe\Domain\ValueObject\RecipeIngredientsCollection;
use App\DietPlanner\Recipe\Domain\ValueObject\RecipeMealType;
use App\DietPlanner\Recipe\Domain\ValueObject\RecipeName;
use App\DietPlanner\Recipe\Domain\ValueObject\ServingSize;
use App\DietPlanner\Shared\Domain\ValueObject\IngredientId;
use App\Shared\Application\Command\Sync\CommandHandler as SyncCommandHandler;
use App\Shared\Application\Service\IdGeneratorInterface;
use App\Shared\Domain\Event\EventBusInterface;

final readonly class CreateRecipeHandler implements SyncCommandHandler
{
    public function __construct(
        private EventBusInterface $eventBus,
        private RecipeRepositoryInterface $recipeRepository,
        private IngredientRepositoryInterface $ingredientRepository,
    ) {}

    public function __invoke(CreateRecipeCommand $command): void
    {
        $this->validateIngredients($command->ingredients);

        $recipe = Recipe::create(
            new RecipeId($command->id),
            new RecipeName($command->name),
            new RecipeDescription($command->description),
            RecipeMealType::from($command->mealType),
            $this->createIngredientCollection($command->ingredients),
            new PreparationInstructions($command->preparationInstructions),
            new PreparationTime($command->preparationTime),
            new ServingSize($command->servingSize)
        );

        $this->eventBus->publish(...$recipe->callEvents());

        $this->recipeRepository->save($recipe);
    }

    private function createIngredientCollection(array $ingredients): RecipeIngredientsCollection
    {
        return RecipeIngredientsCollection::create(
            ...array_map(function ($element) {
               return new RecipeIngredient(
                   new IngredientId($element['id']),
                   new Quantity($element['quantity'])
               );
            }, $ingredients)
        );
    }

    private function validateIngredients(array $ingredients): void
    {
        $ingredientIds = array_map(
            fn($ingredientData) => new IngredientId($ingredientData['id']),
            $ingredients
        );

        $foundIngredients = $this->ingredientRepository->findMultiple($ingredientIds);

        $missingIngredients = array_diff(
            array_map(fn($id) => $id->value(), $ingredientIds),
            array_map(function ($ingredient) {
                return $ingredient->value();
            }, $foundIngredients)
        );

        if (!empty($missingIngredients)) {
            throw new \InvalidArgumentException("Ingredients with ids " . implode(', ', $missingIngredients) . " do not exist");
        }
    }
}
