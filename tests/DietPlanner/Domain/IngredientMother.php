<?php

namespace App\Tests\DietPlanner\Domain;

use App\DietPlanner\Ingredient\Application\Command\Create\CreateIngredientCommand;
use App\DietPlanner\Ingredient\Domain\ValueObject\IngredientTitle;
use App\DietPlanner\Ingredient\Domain\Ingredient;
use App\DietPlanner\Ingredient\Domain\ValueObject\MeasurementType;
use App\DietPlanner\Ingredient\Domain\ValueObject\NutritionalInformation;
use App\DietPlanner\Shared\Domain\ValueObject\IngredientCategoryId;
use App\DietPlanner\Shared\Domain\ValueObject\IngredientId;
use App\Tests\Shared\Domain\IngredientCategoryIdMother;
use App\Tests\Shared\Domain\IngredientIdMother;

class IngredientMother
{
    public static function create(
        ?IngredientId $id = null,
        ?IngredientCategoryId $categoryId = null,
        ?IngredientTitle $title = null,
        ?NutritionalInformation $nutritionalInformation = null,
        ?MeasurementType $measurementType = null
    ): Ingredient {
        return Ingredient::create(
            $id ?? IngredientIdMother::create(),
            $categoryId ?? IngredientCategoryIdMother::create(),
            $title ?? IngredientTitleMother::create() ,
            $nutritionalInformation ?? NutritionalInformationMother::create(),
            $measurementType ?? MeasurementTypeMother::create()
        );
    }

    public static function fromRequest(CreateIngredientCommand $request): Ingredient
    {
        return self::create(
            IngredientIdMother::create($request->id),
            IngredientCategoryIdMother::create($request->ingredientCategoryId),
            IngredientTitleMother::create($request->title),
            NutritionalInformationMother::create($request->nutrients),
            MeasurementTypeMother::create($request->measurementType)
        );
    }
}
