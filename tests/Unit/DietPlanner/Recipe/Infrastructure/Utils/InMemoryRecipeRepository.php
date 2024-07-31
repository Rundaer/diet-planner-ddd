<?php

namespace App\Tests\unit\DietPlanner\Recipe\Infrastructure\Utils;

use App\DietPlanner\Recipe\Domain\Exception\RecipeNotFound;
use App\DietPlanner\Recipe\Domain\Recipe;
use App\DietPlanner\Recipe\Domain\RecipeRepositoryInterface;
use App\DietPlanner\Recipe\Domain\ValueObject\RecipeId;

class InMemoryRecipeRepository implements RecipeRepositoryInterface
{
    private array $recipes = [];

    public function save(Recipe $recipe): void
    {
        $this->recipes[$recipe->id->value()] = $recipe;
    }

    public function find(RecipeId $id): Recipe
    {
        if (isset($this->recipes[$id->value()])) {
            return $this->recipes[$id->value()];
        }

        throw new RecipeNotFound();
    }
}
