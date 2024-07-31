<?php

namespace App\Tests\Utils\DietPlanner\Ingredient\MotherObjects;

use App\DietPlanner\Ingredient\Application\Command\Create\CreateIngredientCommand;
use App\DietPlanner\Ingredient\Domain\ValueObject\IngredientTitle;
use App\DietPlanner\Ingredient\Domain\ValueObject\MeasurementType;
use App\DietPlanner\Ingredient\Domain\ValueObject\NutritionalInformation;
use App\DietPlanner\Shared\Domain\ValueObject\IngredientCategoryId;
use App\DietPlanner\Shared\Domain\ValueObject\IngredientId;
use App\Tests\Utils\DietPlanner\IngredientCategory\MotherObjects\IngredientCategoryIdMother;

class CreateIngredientCommandMother
{
    public static function create(
        ?IngredientId $id = null,
        ?IngredientCategoryId $categoryId = null,
        ?IngredientTitle $title = null,
        ?NutritionalInformation $nutritionalInformation = null,
        ?MeasurementType $measurementType = null
    ): CreateIngredientCommand {
        return new CreateIngredientCommand(
            $id?->value() ?? IngredientIdMother::create()->value(),
            $title?->value() ?? IngredientTitleMother::create()->value(),
            $measurementType?->value ?? MeasurementTypeMother::create()->value,
            $categoryId?->value() ?? IngredientCategoryIdMother::create()->value(),
            $nutritionalInformation?->toArray() ?? NutritionalInformationMother::create()->toArray(),
        );
    }
}
