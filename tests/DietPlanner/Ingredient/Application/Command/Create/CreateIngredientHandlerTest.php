<?php

namespace App\Tests\DietPlanner\Ingredient\Application\Command\Create;

use App\DietPlanner\Ingredient\Application\Command\Create\CreateIngredientHandler;
use App\DietPlanner\Ingredient\Domain\Service\IngredientCreationService;
use App\DietPlanner\Shared\Domain\Exception\InvalidCategoryException;
use App\Tests\DietPlanner\Ingredient\Domain\IngredientCreatedEventMother;
use App\Tests\DietPlanner\Ingredient\Domain\IngredientMother;
use App\Tests\DietPlanner\Ingredient\IngredientModuleUnitTestCase;
use PHPUnit\Framework\Attributes\Test;

class CreateIngredientHandlerTest extends IngredientModuleUnitTestCase
{
    private CreateIngredientHandler|null $handler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->handler = new CreateIngredientHandler(
            new IngredientCreationService(
                $this->repository(),
                $this->ingredientCategoryValidator(),
                $this->eventBus(),
            ),
            $this->idGenerator()
        );
    }

    #[Test]
    public function itShouldCreateIngredient(): void
    {
        $command = CreateIngredientCommandMother::create();

        $ingredient = IngredientMother::fromRequest($command);
        $event = IngredientCreatedEventMother::fromIngredient($ingredient);

        $this->shouldValidateCategoryExists($ingredient->ingredientCategoryId);
        $this->shouldSave($ingredient);
        $this->shouldPublishEvent($event);

        $this->dispatchSync($command, $this->handler);
    }

    #[Test]
    public function itShouldNotCreateIngredientIfCategoryIsNotFound(): void
    {
        $command = CreateIngredientCommandMother::create();

        $ingredient = IngredientMother::fromRequest($command);

        $this->shouldValidateCategoryNotExists($ingredient->ingredientCategoryId);
        $this->expectException(InvalidCategoryException::class);

        $this->dispatchSync($command, $this->handler);
    }
}
