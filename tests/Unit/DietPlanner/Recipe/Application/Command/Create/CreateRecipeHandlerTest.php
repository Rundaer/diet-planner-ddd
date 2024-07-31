<?php

namespace App\Tests\unit\DietPlanner\Recipe\Application\Command\Create;

use App\DietPlanner\Recipe\Application\Command\Create\CreateRecipeHandler;
use App\Tests\unit\DietPlanner\Recipe\Mother\CreateRecipeCommandMother;
use App\Tests\unit\DietPlanner\Recipe\Mother\RecipeMother;
use App\Tests\unit\DietPlanner\Recipe\RecipeModuleUnitTestCase;
use PHPUnit\Framework\Attributes\Test;

class CreateRecipeHandlerTest extends RecipeModuleUnitTestCase
{
    private CreateRecipeHandler|null $handler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->handler = new CreateRecipeHandler(
            $this->eventBus(),
            $this->repository(),
            $this->ingredientRepository(),
        );
    }

    #[Test]
    public function itShouldCreateRecipe(): void
    {
        $command = CreateRecipeCommandMother::create();

        $recipe = RecipeMother::fromRequest($command);

        $this->shouldValidateIngredients($command->ingredients);
        $this->shouldNotPublishEvent();
        $this->shouldSave($recipe);

        $this->dispatchSync($command, $this->handler);
    }
}
