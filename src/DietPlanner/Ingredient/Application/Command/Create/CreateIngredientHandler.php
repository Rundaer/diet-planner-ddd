<?php

namespace App\DietPlanner\Ingredient\Application\Command\Create;

use App\DietPlanner\Ingredient\Domain\Ingredient;
use App\DietPlanner\Ingredient\Domain\IngredientRepositoryInterface;
use App\DietPlanner\Ingredient\Domain\ValueObject\IngredientTitle;
use App\DietPlanner\Ingredient\Domain\ValueObject\MeasurementType;
use App\DietPlanner\Ingredient\Domain\ValueObject\NutritionalInformation;
use App\DietPlanner\IngredientCategory\Domain\Exception\IngredientCategoryNotFound;
use App\DietPlanner\IngredientCategory\Domain\IngredientCategoryRepositoryInterface;
use App\DietPlanner\Shared\Domain\ValueObject\IngredientCategoryId;
use App\DietPlanner\Shared\Domain\ValueObject\IngredientId;
use App\Shared\Application\Command\Async\CommandHandler as AsyncCommandHandler;
use App\Shared\Domain\Event\EventBusInterface;

readonly class CreateIngredientHandler implements AsyncCommandHandler
{
    public function __construct(
        private IngredientRepositoryInterface $ingredientRepository,
        private IngredientCategoryRepositoryInterface $ingredientCategoryRepository,
        private EventBusInterface $eventDispatcher
    ) {}

    public function __invoke(CreateIngredientCommand $command): void
    {
        $ingredientCategoryId = new IngredientCategoryId($command->ingredientCategoryId);

        if (!$this->ingredientCategoryRepository->exists($ingredientCategoryId)) {
            throw new IngredientCategoryNotFound($command->ingredientCategoryId);
        }

        $ingredient = Ingredient::create(
            new IngredientId($command->id),
            $ingredientCategoryId,
            new IngredientTitle($command->title),
            NutritionalInformation::fromArray($command->nutrients),
            MeasurementType::fromName($command->measurementType)
        );

        $this->ingredientRepository->save($ingredient);
        $this->eventDispatcher->publish(...$ingredient->callEvents());
    }
}
