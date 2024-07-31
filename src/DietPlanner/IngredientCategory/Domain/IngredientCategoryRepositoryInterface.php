<?php

namespace App\DietPlanner\IngredientCategory\Domain;

use App\DietPlanner\Shared\Domain\ValueObject\IngredientCategoryId;

interface IngredientCategoryRepositoryInterface
{
    public function save(IngredientCategory $category): void;

    public function find(IngredientCategoryId $id): ?IngredientCategory;

    public function exists(IngredientCategoryId $id): bool;
}
