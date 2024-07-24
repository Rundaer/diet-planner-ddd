<?php

namespace App\DietPlanner\Shared\Domain\Services;

use App\DietPlanner\Shared\Domain\ValueObject\IngredientCategoryId;

interface IngredientCategoryValidatorInterface
{
    public function exists(IngredientCategoryId $id): bool;
}
