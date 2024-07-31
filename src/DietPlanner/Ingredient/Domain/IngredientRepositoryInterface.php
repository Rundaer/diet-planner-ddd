<?php

namespace App\DietPlanner\Ingredient\Domain;

use App\DietPlanner\Ingredient\Domain\Exception\IngredientNotFound;
use App\DietPlanner\Shared\Domain\ValueObject\IngredientId;

interface IngredientRepositoryInterface
{
    public function save(Ingredient $ingredient): void;

    /**
     * @throws IngredientNotFound
     */
    public function find(IngredientId $id): Ingredient;

    /** @param array<IngredientId> $ids */
    public function findMultiple(array $ids): array;
}
