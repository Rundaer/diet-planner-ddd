<?php

namespace App\Tests\DietPlanner\Ingredient\Infrastructure\Persistence;

use App\DietPlanner\Ingredient\Domain\Ingredient;
use App\DietPlanner\Ingredient\Domain\Repository\IngredientRepositoryInterface;
use App\DietPlanner\Shared\Domain\ValueObject\IngredientId;

class InMemoryIngredientRepository implements IngredientRepositoryInterface
{
    private array $ingredients = [];

    public function save(Ingredient $ingredient): void
    {
        $this->ingredients[$ingredient->ingredientId->value()] = $ingredient;
    }

    public function find(IngredientId $id): ?Ingredient
    {
        return $this->ingredients[$id->value()] ?? null;
    }
}
