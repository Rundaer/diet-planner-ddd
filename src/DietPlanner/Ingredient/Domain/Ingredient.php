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
        private IngredientCategoryId $ingredientCategoryId,
        private IngredientTitle $title,
        private NutritionalInformation $nutritionalInformation,
        private MeasurementType $measurementType
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

    public function getIngredientCategoryId(): IngredientCategoryId
    {
        return $this->ingredientCategoryId;
    }

    public function getTitle(): IngredientTitle
    {
        return $this->title;
    }

    public function getNutritionalInformation(): NutritionalInformation
    {
        return $this->nutritionalInformation;
    }

    public function getMeasurementType(): MeasurementType
    {
        return $this->measurementType;
    }
}
