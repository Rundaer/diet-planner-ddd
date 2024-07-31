<?php

namespace App\DietPlanner\Recipe\Application\Command\Create;

use App\Shared\Application\Command\Sync\Command as SyncCommand;

final readonly class CreateRecipeCommand implements SyncCommand
{
    public function __construct(
        public string $id,
        public string $name,
        public string $description,
        public string $mealType,
        public array $ingredients,
        public string $preparationInstructions,
        public int $preparationTime,
        public int $servingSize,
    ) {}
}
