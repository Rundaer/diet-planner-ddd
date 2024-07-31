<?php

namespace App\Tests\Integration\DietPlanner\Ingredient\Infrastructure\Persistence;

use App\DietPlanner\Ingredient\Domain\Exception\IngredientNotFound;
use App\Tests\unit\DietPlanner\Ingredient\IngredientModuleIntegrationTestCase;
use App\Tests\Utils\DietPlanner\Ingredient\MotherObjects\IngredientIdMother;
use App\Tests\Utils\DietPlanner\Ingredient\MotherObjects\IngredientMother;
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
