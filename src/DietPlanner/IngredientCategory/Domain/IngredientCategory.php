<?php

namespace App\DietPlanner\IngredientCategory\Domain;

use App\DietPlanner\IngredientCategory\Domain\ValueObject\IngredientCategoryName;
use App\DietPlanner\Shared\Domain\ValueObject\IngredientCategoryId;

readonly class IngredientCategory
{
    public function __construct(
        public IngredientCategoryId $id,
        public IngredientCategoryName $name
    ) {}

    public static function restore(
        IngredientCategoryId $id,
        IngredientCategoryName $name
    ): IngredientCategory {
       return new self($id, $name);
    }
}
