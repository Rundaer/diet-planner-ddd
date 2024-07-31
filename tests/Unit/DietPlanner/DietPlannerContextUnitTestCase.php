<?php

namespace App\Tests\Unit\DietPlanner;

use App\Tests\Unit\DietPlanner\Ingredient\IngredientContextUnitTestCase;
use App\Tests\Unit\DietPlanner\IngredientCategory\IngredientCategoryContextUnitTestCase;
use App\Tests\Utils\Shared\UnitTestCase;

class DietPlannerContextUnitTestCase extends UnitTestCase
{
    use IngredientContextUnitTestCase;
    use IngredientCategoryContextUnitTestCase;
}
