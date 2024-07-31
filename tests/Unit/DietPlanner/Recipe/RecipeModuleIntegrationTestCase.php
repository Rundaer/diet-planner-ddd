<?php

namespace App\Tests\unit\DietPlanner\Recipe;

use App\DietPlanner\Recipe\Domain\RecipeRepositoryInterface;
use App\Tests\unit\DietPlanner\Recipe\Infrastructure\Utils\InMemoryRecipeRepository;
use App\Tests\Utils\Shared\InfrastructureTestCase;

abstract class RecipeModuleIntegrationTestCase extends InfrastructureTestCase
{
    private ?RecipeRepositoryInterface $repository = null;

    protected function repository(): RecipeRepositoryInterface
    {
        return $this->repository ??= new InMemoryRecipeRepository();
    }
}
