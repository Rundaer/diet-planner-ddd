<?php

namespace App\Tests\DietPlanner\Ingredient;

use App\DietPlanner\Ingredient\Domain\IngredientRepositoryInterface;
use App\DietPlanner\Ingredient\Infrastructure\Utils\IngredientCategoryRepository;
use App\Tests\Shared\Infrastructure\PhpUnit\InfrastructureTestCase;

abstract class IngredientModuleIntegrationTestCase extends InfrastructureTestCase
{
    private ?IngredientRepositoryInterface $repository = null;

    protected function repository(): IngredientRepositoryInterface
    {
        return $this->repository ??= new InMemoryIngredientRepository();
//        return $this->repository ??= $this->service(IngredientCategoryRepository::class);
    }
}
