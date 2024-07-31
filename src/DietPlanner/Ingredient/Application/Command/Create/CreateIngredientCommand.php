<?php

namespace App\DietPlanner\Ingredient\Application\Command\Create;

use App\Shared\Application\Command\Async\Command as AsyncCommand;
use JetBrains\PhpStorm\ArrayShape;

final readonly class CreateIngredientCommand implements AsyncCommand
{
    public function __construct(
        public string $id,
        public string $title,
        public string $measurementType,
        public string $ingredientCategoryId,
        #[ArrayShape([
            'calories' => 'string',
            'protein' => 'string',
            'carbohydrates' => 'string',
            'fats' => 'string'
        ])]
        public array $nutrients,
    ) {}
}
