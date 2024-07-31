<?php

namespace App\DietPlanner\Ingredient\Domain;

use App\DietPlanner\Ingredient\Domain\Event\IngredientCreated;
use App\DietPlanner\Ingredient\Domain\ValueObject\IngredientTitle;
use App\DietPlanner\Ingredient\Domain\ValueObject\MeasurementType;
use App\DietPlanner\Ingredient\Domain\ValueObject\NutritionalInformation;
use App\DietPlanner\Shared\Domain\ValueObject\IngredientCategoryId;
use App\DietPlanner\Shared\Domain\ValueObject\IngredientId;
use App\Shared\Domain\AggregateRoot;

final class Ingredient extends AggregateRoot
{
    private function __construct(
        public readonly IngredientId $ingredientId,
        public readonly IngredientCategoryId $ingredientCategoryId,
        public readonly IngredientTitle $title,
        public readonly NutritionalInformation $nutritionalInformation,
        public readonly MeasurementType $measurementType
    ) {}

    public static function create(
        IngredientId $ingredientId,
        IngredientCategoryId $ingredientCategoryId,
        IngredientTitle $title,
        NutritionalInformation $nutritionalInformation,
        MeasurementType $measurementType
    ): self {
        $ingredient = new self($ingredientId, $ingredientCategoryId, $title, $nutritionalInformation, $measurementType);

        $ingredient->record(IngredientCreated::create($ingredientId));

        return $ingredient;
    }

    public static function restore(
        IngredientId $ingredientId,
        IngredientCategoryId $ingredientCategoryId,
        IngredientTitle $title,
        NutritionalInformation $nutritionalInformation,
        MeasurementType $measurementType
    ): Ingredient {
        return new self($ingredientId, $ingredientCategoryId, $title, $nutritionalInformation, $measurementType);
    }
}
