<?php

namespace App\DietPlanner\IngredientCategory\Domain;

use App\DietPlanner\Shared\Domain\ValueObject\IngredientCategoryId;

interface IngredientCategoryInterface
{
    public function save(IngredientCategory $category): void;

    public function find(IngredientCategoryId $id): ?IngredientCategory;
}
