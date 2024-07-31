<?php

namespace App\Tests\Unit\DietPlanner\Ingredient\Application\Command\Create;

use App\DietPlanner\Ingredient\Application\Command\Create\CreateIngredientHandler;
use App\DietPlanner\IngredientCategory\Domain\Exception\IngredientCategoryNotFound;
use App\Tests\Unit\DietPlanner\DietPlannerContextUnitTestCase;
use App\Tests\Utils\DietPlanner\Ingredient\MotherObjects\CreateIngredientCommandMother;
use App\Tests\Utils\DietPlanner\Ingredient\MotherObjects\IngredientCreatedEventMother;
use App\Tests\Utils\DietPlanner\Ingredient\MotherObjects\IngredientMother;
use PHPUnit\Framework\Attributes\Test;

class CreateIngredientHandlerTest extends DietPlannerContextUnitTestCase
{
    private CreateIngredientHandler|null $handler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->handler = new CreateIngredientHandler(
            $this->ingredientRepository(),
            $this->ingredientCategoryRepository(),
            $this->eventBus(),
        );
    }

    #[Test]
    public function itShouldCreateIngredient(): void
    {
        $command = CreateIngredientCommandMother::create();

        $ingredient = IngredientMother::fromRequest($command);
        $event = IngredientCreatedEventMother::fromIngredient($ingredient);

        $this->shouldFindExistingIngredientCategory($ingredient->ingredientCategoryId);
        $this->shouldSaveIngredient($ingredient);
        $this->shouldPublishEvent($event);

        $this->dispatchAsync($command, $this->handler);
    }

    #[Test]
    public function itShouldNotCreateIngredientIfCategoryIsNotFound(): void
    {
        $command = CreateIngredientCommandMother::create();

        $ingredient = IngredientMother::fromRequest($command);

        $this->shouldNotFindIngredientCategory($ingredient->ingredientCategoryId);
        $this->expectException(IngredientCategoryNotFound::class);

        $this->dispatchAsync($command, $this->handler);
    }
}
