<?php

namespace App\Tests\unit\DietPlanner\Recipe;

use App\DietPlanner\Ingredient\Domain\IngredientRepositoryInterface;
use App\DietPlanner\Recipe\Domain\Recipe;
use App\DietPlanner\Recipe\Domain\RecipeRepositoryInterface;
use App\DietPlanner\Recipe\Domain\ValueObject\RecipeId;
use App\DietPlanner\Shared\Domain\ValueObject\IngredientId;
use App\Tests\Utils\Shared\UnitTestCase;
use Mockery;
use Mockery\MockInterface;

class RecipeModuleUnitTestCase extends UnitTestCase
{
    protected RecipeRepositoryInterface|MockInterface|null $repository = null;
    protected IngredientRepositoryInterface|MockInterface|null $ingredientRepository = null;

    protected function repository(): RecipeRepositoryInterface|MockInterface
    {
        return $this->repository ??= $this->mock(RecipeRepositoryInterface::class);
    }

    protected function ingredientRepository(): IngredientRepositoryInterface|MockInterface
    {
        return $this->ingredientRepository ??= $this->mock(IngredientRepositoryInterface::class);
    }

    protected function shouldSave(Recipe $recipe): void
    {
        $this->repository()
            ->shouldReceive('save')
            ->with(Mockery::on(function ($arg) use ($recipe) {
                return $arg instanceof Recipe
                    && $arg->id->equals($recipe->id)
                ;
            }))
            ->once()
            ->andReturnNull();
    }

    protected function shouldFind(RecipeId $id, ?Recipe $recipe = null): void
    {
        $this->repository()
            ->shouldReceive('find')
            ->with(Mockery::on(function ($arg) use ($id) {
                return $arg instanceof RecipeId
                    && $id->equals($arg)
                    ;
            }))
            ->once()
            ->andReturn($recipe);
    }

    protected function shouldValidateIngredients(array $ingredients): void
    {
        $ingredientIds = \array_map(
            fn($ingredientData) => new IngredientId($ingredientData['id']),
            $ingredients
        );

        $this->ingredientRepository()
            ->expects('findMultiple')
            ->with($ingredientIds)
            ->andReturn($ingredientIds);
    }
}
