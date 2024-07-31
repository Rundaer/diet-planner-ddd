<?php

namespace App\DietPlanner\Recipe\Domain;

use App\DietPlanner\Recipe\Domain\Exception\RecipeNotFound;
use App\DietPlanner\Recipe\Domain\ValueObject\RecipeId;

interface RecipeRepositoryInterface
{
    public function save(Recipe $recipe): void;

    /**
     * @throws RecipeNotFound
     */
    public function find(RecipeId $id): Recipe;
}
