<?php

namespace App\Tests\unit\DietPlanner\Recipe\Domain;

use App\DietPlanner\Recipe\Domain\ValueObject\RecipeIngredientsCollection;
use App\Tests\unit\DietPlanner\Recipe\Mother\RecipeIngredientMother;
use App\Tests\unit\DietPlanner\Recipe\RecipeModuleUnitTestCase;
use PHPUnit\Framework\Attributes\Test;

class RecipeIngredientsCollectionTest extends RecipeModuleUnitTestCase
{
    #[Test]
    public function itShouldAddRecipeIngredientsWithoutPosition()
    {
        $recipeIngredient = RecipeIngredientMother::create();

        $collection = RecipeIngredientsCollection::create($recipeIngredient);

        $this->assertCount(1, $collection->getAll());
        $this->assertEquals($recipeIngredient, $collection->getAll()[1]);
    }

    #[Test]
    public function isShouldAddRecipeIngredientWithPosition()
    {
        $recipeIngredient2 = RecipeIngredientMother::create();

        $collection = RecipeIngredientsCollection::create(
            RecipeIngredientMother::create()
        );

        $collection->add($recipeIngredient2, 2);

        $this->assertSame(2, $collection->count());
        $this->assertEquals($recipeIngredient2, $collection->getAll()[2]);
    }

    #[Test]
    public function isShouldShiftPositionAfterAddingRecipeIngredientWithSamePosition()
    {
        $collection = RecipeIngredientsCollection::create(
            RecipeIngredientMother::create(),
            RecipeIngredientMother::create(),
            RecipeIngredientMother::create(),
        );

        $addedRecipeIngredient = RecipeIngredientMother::create();
        $collection->add($addedRecipeIngredient, 1);

        $this->assertSame(4, $collection->count());
        $this->assertEquals($addedRecipeIngredient, $collection->getAll()[1]);

    }
}
