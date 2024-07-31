<?php

namespace App\Tests\Unit\DietPlanner\IngredientCategory;

use App\DietPlanner\IngredientCategory\Domain\IngredientCategory;
use App\DietPlanner\IngredientCategory\Domain\IngredientCategoryRepositoryInterface;
use App\DietPlanner\Shared\Domain\ValueObject\IngredientCategoryId;
use Mockery;
use Mockery\MockInterface;

trait IngredientCategoryContextUnitTestCase
{
    protected IngredientCategoryRepositoryInterface|MockInterface|null $ingredientCategoryRepository = null;

    protected function ingredientCategoryRepository(): IngredientCategoryRepositoryInterface|MockInterface
    {
        return $this->ingredientCategoryRepository ??= $this->mock(IngredientCategoryRepositoryInterface::class);
    }

    protected function shouldSaveIngredientCategory(IngredientCategory $ingredientCategory): void
    {
        $this->ingredientCategoryRepository()
            ->shouldReceive('save')
            ->with(Mockery::on(function ($arg) use ($ingredientCategory) {
                return $arg instanceof IngredientCategory
                    && $arg->id->equals($ingredientCategory->id)
                ;
            }))
            ->once()
            ->andReturnNull();
    }

    protected function shouldFindIngredientCategory(IngredientCategoryId $id, ?IngredientCategory $ingredientCategory = null): void
    {
        $this->ingredientCategoryRepository()
            ->shouldReceive('find')
            ->with(Mockery::on(function ($arg) use ($id) {
                return $arg instanceof IngredientCategoryId
                    && $id->equals($arg)
                ;
            }))
            ->once()
            ->andReturn($ingredientCategory);
    }

    protected function shouldFindExistingIngredientCategory(IngredientCategoryId $categoryId): void
    {
        $this->ingredientCategoryRepository()
            ->shouldReceive('exists')
            ->once()
            ->with(Mockery::on(function ($arg) use ($categoryId) {
                return $arg instanceof IngredientCategoryId && $arg->equals($categoryId);
            }))
            ->andReturnTrue(); // Assuming the category exists. Adjust as necessary.
    }

    protected function shouldNotFindIngredientCategory(IngredientCategoryId $categoryId): void
    {
        $this->ingredientCategoryRepository()
            ->shouldReceive('exists')
            ->once()
            ->with(Mockery::on(function ($arg) use ($categoryId) {
                return $arg instanceof IngredientCategoryId && $arg->equals($categoryId);
            }))
            ->andReturnFalse();
    }
}
