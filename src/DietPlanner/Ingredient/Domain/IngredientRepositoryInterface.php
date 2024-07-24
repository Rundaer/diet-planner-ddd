<?php

namespace App\DietPlanner\Ingredient\Domain;

use App\DietPlanner\Shared\Domain\ValueObject\IngredientId;

interface IngredientRepositoryInterface
{
    public function save(Ingredient $ingredient): void;

    public function find(IngredientId $id): ?Ingredient;
}
