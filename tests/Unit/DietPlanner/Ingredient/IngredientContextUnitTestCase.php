<?php

namespace App\Tests\Unit\DietPlanner\Ingredient;

use App\DietPlanner\Ingredient\Domain\Ingredient;
use App\DietPlanner\Ingredient\Domain\IngredientRepositoryInterface;
use App\DietPlanner\Shared\Domain\ValueObject\IngredientId;
use Mockery;
use Mockery\MockInterface;

trait IngredientContextUnitTestCase
{
    protected IngredientRepositoryInterface|MockInterface|null $ingredientRepository = null;

    protected function ingredientRepository(): IngredientRepositoryInterface|MockInterface
    {
        return $this->ingredientRepository ??= $this->mock(IngredientRepositoryInterface::class);
    }

    protected function shouldSaveIngredient(Ingredient $ingredient): void
    {
        $this->ingredientRepository()
            ->shouldReceive('save')
            ->with(Mockery::on(function ($arg) use ($ingredient) {
                return $arg instanceof Ingredient
                    && $arg->ingredientId->equals($ingredient->ingredientId)
                    && $arg->ingredientCategoryId->equals($ingredient->ingredientCategoryId)
                    && $arg->title->equals($ingredient->title)
                    && $arg->nutritionalInformation->equals($ingredient->nutritionalInformation)
                    && $arg->measurementType === $ingredient->measurementType;
            }))
            ->once()
            ->andReturnNull();
    }

    protected function shouldFindIngredient(IngredientId $id, ?Ingredient $ingredient = null): void
    {
        $this->ingredientRepository()
            ->shouldReceive('find')
            ->with(Mockery::on(function ($arg) use ($id) {
                return $arg instanceof IngredientId
                    && $id->equals($arg);
            }))
            ->once()
            ->andReturn($ingredient);
    }
}
