<?php

namespace App\DietPlanner\IngredientCategory\Domain\Exception;

use App\Shared\Domain\Exception\NotFoundException;

class IngredientCategoryNotFound extends NotFoundException
{
    public function __construct(string $id)
    {
        $message = sprintf('Ingredient category with id "%s" could not be found.', $id);

        parent::__construct($message);
    }
}
