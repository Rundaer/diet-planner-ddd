<?php

namespace App\Tests\DietPlanner\Ingredient;

use App\DietPlanner\Ingredient\Domain\Repository\IngredientRepositoryInterface;
use App\DietPlanner\Ingredient\Infrastructure\Utils\IngredientRepository;
use App\Tests\DietPlanner\Ingredient\Infrastructure\Persistence\InMemoryIngredientRepository;
use App\Tests\Shared\Infrastructure\PhpUnit\InfrastructureTestCase;

abstract class IngredientModuleIntegrationTestCase extends InfrastructureTestCase
{
    private ?IngredientRepositoryInterface $repository = null;

    protected function repository(): IngredientRepositoryInterface
    {
        //return $this->repository ??= new InMemoryIngredientRepository();

        return $this->repository ??= $this->service(IngredientRepository::class);
    }
}
