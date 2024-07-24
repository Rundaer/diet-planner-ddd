<?php

namespace App\DietPlanner\Ingredient\Application\Command\Create;

use App\DietPlanner\Ingredient\Domain\Ingredient;
use App\DietPlanner\Ingredient\Domain\IngredientRepositoryInterface;
use App\DietPlanner\Ingredient\Domain\ValueObject\IngredientTitle;
use App\DietPlanner\Ingredient\Domain\ValueObject\MeasurementType;
use App\DietPlanner\Ingredient\Domain\ValueObject\NutritionalInformation;
use App\DietPlanner\Shared\Domain\ValueObject\IngredientCategoryId;
use App\DietPlanner\Shared\Domain\ValueObject\IngredientId;
use App\Shared\Application\Command\Sync\CommandHandler as SyncCommandHandler;
use App\Shared\Application\Service\IdGeneratorInterface;
use App\Shared\Domain\Event\EventBusInterface;

readonly class CreateIngredientHandler implements SyncCommandHandler
{
    public function __construct(
        private IngredientRepositoryInterface $repository,
        private EventBusInterface $eventDispatcher,
        private IdGeneratorInterface $idGenerator,
    ) {}

    public function __invoke(CreateIngredientCommand $command): void
    {
        $ingredientId = ($command->id !== null)
            ? new IngredientId($command->id)
            : new IngredientId($this->idGenerator->generate()->value());

        $ingredient = Ingredient::create(
            $ingredientId,
            new IngredientCategoryId($command->ingredientCategoryId),
            new IngredientTitle($command->title),
            NutritionalInformation::fromArray($command->nutrients),
            MeasurementType::from($command->measurementType)
        );

        $this->repository->save($ingredient);

        $this->eventDispatcher->publish(...$ingredient->callEvents());
    }
}
