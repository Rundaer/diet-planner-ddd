<?php

namespace App\Tests\unit\DietPlanner\Recipe\Domain;

use App\DietPlanner\Recipe\Domain\Recipe;
use App\Tests\unit\DietPlanner\Recipe\Mother\PreparationInstructionsMother;
use App\Tests\unit\DietPlanner\Recipe\Mother\PreparationTimeMother;
use App\Tests\unit\DietPlanner\Recipe\Mother\RecipeDescriptionMother;
use App\Tests\unit\DietPlanner\Recipe\Mother\RecipeIngredientCollectionMother;
use App\Tests\unit\DietPlanner\Recipe\Mother\RecipeMealTypeMother;
use App\Tests\unit\DietPlanner\Recipe\Mother\RecipeMother;
use App\Tests\unit\DietPlanner\Recipe\Mother\RecipeNameMother;
use App\Tests\unit\DietPlanner\Recipe\Mother\ServingSizeMother;
use App\Tests\unit\DietPlanner\Recipe\RecipeModuleUnitTestCase;
use PHPUnit\Framework\Attributes\Test;

class RecipeTest extends RecipeModuleUnitTestCase
{
    #[Test]
    public function itShouldCreateRecipeWithValidData()
    {
        $id = \App\Tests\Utils\Shared\MotherObjects\RecipeIdMother::create();
        $name = RecipeNameMother::create('Spaghetti Bolognese');
        $description = RecipeDescriptionMother::create('A classic Italian dish');
        $type = RecipeMealTypeMother::create('dinner');
        $ingredients = RecipeIngredientCollectionMother::create();
        $preparationInstructions = PreparationInstructionsMother::create('Cook spaghetti. Make sauce. Combine.');
        $preparationTime = PreparationTimeMother::create(30);
        $servingSize = ServingSizeMother::create(4);

        $recipe = RecipeMother::create(
            $id,
            $name,
            $description,
            $type,
            $ingredients,
            $preparationInstructions,
            $preparationTime,
            $servingSize
        );

        $this->assertInstanceOf(Recipe::class, $recipe);
        $this->assertEquals($id, $recipe->id);
        $this->assertEquals($name, $recipe->name);
        $this->assertEquals($description, $recipe->description);
        $this->assertEquals($type, $recipe->type);
        $this->assertEquals($ingredients, $recipe->ingredients);
        $this->assertEquals($preparationInstructions, $recipe->preparationInstructions);
        $this->assertEquals($preparationTime, $recipe->preparationTime);
        $this->assertEquals($servingSize, $recipe->servingSize);
    }
}
