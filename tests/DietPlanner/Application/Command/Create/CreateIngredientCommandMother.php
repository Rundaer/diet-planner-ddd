<?php

namespace App\Tests\DietPlanner\Application\Command\Create;

use App\DietPlanner\Ingredient\Application\Command\Create\CreateIngredientCommand;
use App\DietPlanner\Ingredient\Domain\ValueObject\IngredientTitle;
use App\DietPlanner\Ingredient\Domain\ValueObject\MeasurementType;
use App\DietPlanner\Ingredient\Domain\ValueObject\NutritionalInformation;
use App\DietPlanner\Shared\Domain\ValueObject\IngredientCategoryId;
use App\DietPlanner\Shared\Domain\ValueObject\IngredientId;
use App\Tests\DietPlanner\Domain\IngredientTitleMother;
use App\Tests\DietPlanner\Domain\MeasurementTypeMother;
use App\Tests\DietPlanner\Domain\NutritionalInformationMother;
use App\Tests\Shared\Domain\IngredientCategoryIdMother;
use App\Tests\Shared\Domain\IngredientIdMother;

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
            $title?->value() ?? IngredientTitleMother::create()->value(),
            $measurementType?->value ?? MeasurementTypeMother::create()->value,
            $categoryId?->value() ?? IngredientCategoryIdMother::create()->value(),
            $nutritionalInformation?->toArray() ?? NutritionalInformationMother::create()->toArray(),
            $id?->value() ?? IngredientIdMother::create()->value(),
        );
    }
}
