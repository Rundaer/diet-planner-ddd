<?php

namespace App\Tests\Utils\DietPlanner\IngredientCategory;

use App\DietPlanner\IngredientCategory\Domain\Exception\IngredientCategoryNotFound;
use App\DietPlanner\IngredientCategory\Domain\IngredientCategory;
use App\DietPlanner\Shared\Domain\ValueObject\IngredientCategoryId;

class InMemoryCategoryIngredientRepository
{
    private array $ingredientCategories = [];

    public function save(IngredientCategory $ingredientCategory): void
    {
        $this->ingredientCategories[$ingredientCategory->id->value()] = $ingredientCategory;
    }

    public function find(IngredientCategoryId $id): IngredientCategory
    {
        if (isset($this->ingredientCategories[$id->value()])) {
            return $this->ingredientCategories[$id->value()];
        }

        throw new IngredientCategoryNotFound($id->value());
    }
}
