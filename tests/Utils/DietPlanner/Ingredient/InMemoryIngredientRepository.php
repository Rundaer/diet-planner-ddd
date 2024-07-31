<?php

namespace App\Tests\Utils\DietPlanner\Ingredient;

use App\DietPlanner\Ingredient\Domain\Exception\IngredientNotFound;
use App\DietPlanner\Ingredient\Domain\Ingredient;
use App\DietPlanner\Ingredient\Domain\IngredientRepositoryInterface;
use App\DietPlanner\Shared\Domain\ValueObject\IngredientId;

class InMemoryIngredientRepository implements IngredientRepositoryInterface
{
    private array $ingredients = [];

    public function save(Ingredient $ingredient): void
    {
        $this->ingredients[$ingredient->ingredientId->value()] = $ingredient;
    }

    public function find(IngredientId $id): Ingredient
    {
        if (isset($this->ingredients[$id->value()])) {
            return $this->ingredients[$id->value()];
        }

        throw new IngredientNotFound();
    }

    /**
     * @param array<IngredientId> $ids
     * @return array<Ingredient>
     */
    public function findMultiple(array $ids): array
    {
        $found = [];

        foreach ($ids as $id) {
            $found[$id->value()] = $this->find($id);
        }

        return $found;
    }
}
