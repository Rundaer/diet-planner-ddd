<?php

namespace App\Tests\DietPlanner\Ingredient;

use App\DietPlanner\Ingredient\Domain\Ingredient;
use App\DietPlanner\Ingredient\Domain\IngredientRepositoryInterface;
use App\DietPlanner\Shared\Domain\ValueObject\IngredientId;
use App\Tests\Shared\Infrastructure\PhpUnit\Traits\IngredientCategoryValidatorTrait;
use App\Tests\Shared\Infrastructure\PhpUnit\UnitTestCase;
use Mockery;
use Mockery\MockInterface;

abstract class IngredientModuleUnitTestCase extends UnitTestCase
{
    use IngredientCategoryValidatorTrait;

    protected IngredientRepositoryInterface|MockInterface|null $repository = null;

    protected function repository(): IngredientRepositoryInterface|MockInterface
    {
        return $this->repository ??= $this->mock(IngredientRepositoryInterface::class);
    }

    protected function shouldSave(Ingredient $ingredient): void
    {
        $this->repository()
            ->shouldReceive('save')
            ->with(Mockery::on(function ($arg) use ($ingredient) {
                return $arg instanceof Ingredient
                    && $arg->ingredientId->equals($ingredient->ingredientId)
                    && $arg->ingredientCategoryId->equals($ingredient->ingredientCategoryId)
                    && $arg->title->equals($ingredient->title)
                    && $arg->nutritionalInformation->equals($ingredient->nutritionalInformation)
                    && $arg->measurementType === $ingredient->measurementType
                ;
            }))
            ->once()
            ->andReturnNull();
    }

    protected function shouldFind(IngredientId $id, ?Ingredient $ingredient = null): void
    {
        $this->repository()
            ->shouldReceive('find')
            ->with(Mockery::on(function ($arg) use ($id) {
                return $arg instanceof IngredientId
                    && $id->equals($arg)
                ;
            }))
            ->once()
            ->andReturn($ingredient);
    }
}
