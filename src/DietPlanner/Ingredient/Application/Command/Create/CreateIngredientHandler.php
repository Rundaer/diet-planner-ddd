<?php

namespace App\DietPlanner\Ingredient\Application\Command\Create;

use App\DietPlanner\Ingredient\Domain\Service\IngredientCreationService;
use App\DietPlanner\Ingredient\Domain\ValueObject\IngredientTitle;
use App\DietPlanner\Ingredient\Domain\ValueObject\MeasurementType;
use App\DietPlanner\Ingredient\Domain\ValueObject\NutritionalInformation;
use App\DietPlanner\Shared\Domain\ValueObject\IngredientCategoryId;
use App\DietPlanner\Shared\Domain\ValueObject\IngredientId;
use App\Shared\Application\Command\Sync\CommandHandler as SyncCommandHandler;
use App\Shared\Application\Service\IdGeneratorInterface;

readonly class CreateIngredientHandler implements SyncCommandHandler
{
    public function __construct(
        private IngredientCreationService $creationService,
        private IdGeneratorInterface $idGenerator,
    ) {}

    public function __invoke(CreateIngredientCommand $command): void
    {
        $ingredientId = ($command->id !== null)
            ? new IngredientId($command->id)
            : new IngredientId($this->idGenerator->generate()->value())
        ;

        $this->creationService->createIngredient(
            $ingredientId,
            new IngredientCategoryId($command->ingredientCategoryId),
            new IngredientTitle($command->title),
            NutritionalInformation::fromArray($command->nutrients),
            MeasurementType::from($command->measurementType)
        );
    }
}
