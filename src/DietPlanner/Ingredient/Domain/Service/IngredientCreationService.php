<?php

namespace App\DietPlanner\Ingredient\Domain\Service;

use App\DietPlanner\Ingredient\Domain\Ingredient;
use App\DietPlanner\Ingredient\Domain\IngredientRepositoryInterface;
use App\DietPlanner\Ingredient\Domain\ValueObject\IngredientTitle;
use App\DietPlanner\Ingredient\Domain\ValueObject\MeasurementType;
use App\DietPlanner\Ingredient\Domain\ValueObject\NutritionalInformation;
use App\DietPlanner\Shared\Domain\Exception\InvalidCategoryException;
use App\DietPlanner\Shared\Domain\Services\IngredientCategoryValidatorInterface;
use App\DietPlanner\Shared\Domain\ValueObject\IngredientCategoryId;
use App\DietPlanner\Shared\Domain\ValueObject\IngredientId;
use App\Shared\Domain\Event\EventBusInterface;

readonly class IngredientCreationService
{
    public function __construct(
        private IngredientRepositoryInterface $ingredientRepository,
        private IngredientCategoryValidatorInterface $categoryValidator,
        private EventBusInterface $eventDispatcher
    ) {}

    public function createIngredient(
        IngredientId $id,
        IngredientCategoryId $categoryId,
        IngredientTitle $ingredientTitle,
        NutritionalInformation $nutritionalInformation,
        MeasurementType $measurementType,
    ): void {
        if (!$this->categoryValidator->exists($categoryId)) {
            throw new InvalidCategoryException('Category does not exist');
        }

        $ingredient = Ingredient::create(
            $id,
            $categoryId,
            $ingredientTitle,
            $nutritionalInformation,
            $measurementType,
        );

        $this->ingredientRepository->save($ingredient);

        $this->eventDispatcher->publish(...$ingredient->callEvents());
    }
}
