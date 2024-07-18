<?php

namespace App\DietPlanner\Ingredient\Domain\Repository;

use App\DietPlanner\Ingredient\Domain\Ingredient;
use App\DietPlanner\Shared\Domain\ValueObject\IngredientId;

interface IngredientRepositoryInterface
{
    public function save(Ingredient $ingredient): void;

    public function find(IngredientId $id): ?Ingredient;
}
