<?php

namespace App\Tests\Shared\Infrastructure\PhpUnit\Traits;

use App\DietPlanner\Shared\Domain\Services\IngredientCategoryValidatorInterface;
use App\DietPlanner\Shared\Domain\ValueObject\IngredientCategoryId;
use Mockery;
use Mockery\MockInterface;

trait IngredientCategoryValidatorTrait
{
    private readonly IngredientCategoryValidatorInterface|MockInterface|null $ingredientCategoryValidator;

    protected function ingredientCategoryValidator(): MockInterface|IngredientCategoryValidatorInterface
    {
        return $this->ingredientCategoryValidator ??= $this->mock(IngredientCategoryValidatorInterface::class);
    }

    protected function shouldValidateCategoryExists(IngredientCategoryId $categoryId): void
    {
        $this->ingredientCategoryValidator()
            ->shouldReceive('exists')
            ->once()
            ->with(Mockery::on(function ($arg) use ($categoryId) {
                return $arg instanceof IngredientCategoryId && $arg->equals($categoryId);
            }))
            ->andReturnTrue(); // Assuming the category exists. Adjust as necessary.
    }

    protected function shouldValidateCategoryNotExists(IngredientCategoryId $categoryId): void
    {
        $this->ingredientCategoryValidator()
            ->shouldReceive('exists')
            ->once()
            ->with(Mockery::on(function ($arg) use ($categoryId) {
                return $arg instanceof IngredientCategoryId && $arg->equals($categoryId);
            }))
            ->andReturnFalse();
    }
}
