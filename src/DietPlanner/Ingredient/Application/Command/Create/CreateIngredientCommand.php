<?php

namespace App\DietPlanner\Ingredient\Application\Command\Create;

use App\Shared\Application\Command\Sync\Command as SyncCommand;
use JetBrains\PhpStorm\ArrayShape;

final readonly class CreateIngredientCommand implements SyncCommand
{
    public function __construct(
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
        public ?string $id = null,
    ) {}
}
