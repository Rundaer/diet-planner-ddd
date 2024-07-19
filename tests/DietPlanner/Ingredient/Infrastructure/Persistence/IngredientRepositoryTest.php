<?php

namespace App\Tests\DietPlanner\Ingredient\Infrastructure\Persistence;

use App\DietPlanner\Ingredient\Domain\Exception\IngredientNotFound;
use App\DietPlanner\Ingredient\Domain\Ingredient;
use App\DietPlanner\Ingredient\Domain\Repository\IngredientRepositoryInterface;
use App\DietPlanner\Shared\Domain\ValueObject\IngredientId;
use App\Tests\DietPlanner\Ingredient\Domain\IngredientMother;
use App\Tests\DietPlanner\Ingredient\IngredientModuleIntegrationTestCase;
use App\Tests\Shared\Domain\IngredientIdMother;
use PHPUnit\Framework\Attributes\Test;

class IngredientRepositoryTest extends IngredientModuleIntegrationTestCase
{
    #[Test]
    public function itShouldCreateAndReturnAnExistingIngredient(): void
    {
        $ingredient = IngredientMother::create();

        $this->repository()->save($ingredient);

        $entityIngredient = $this->repository()->find($ingredient->ingredientId);

        $this->assertObjectEquals($ingredient->ingredientId, $entityIngredient->ingredientId);
    }

    #[Test]
    public function itShouldNotReturnNotExistingIngredient(): void
    {
        $this->expectException(IngredientNotFound::class);

        $this->assertNull($this->repository()->find(IngredientIdMother::create()));
    }
}
