<?php

namespace App\Tests\DietPlanner\Ingredient\Application\Command\Create;

use App\DietPlanner\Ingredient\Application\Command\Create\CreateIngredientHandler;
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
            $this->repository(),
            $this->eventBus(),
            $this->idGenerator()
        );
    }

    #[Test]
    public function itShouldCreateIngredient(): void
    {
        $command = CreateIngredientCommandMother::create();

        $ingredient = IngredientMother::fromRequest($command);
        $event = IngredientCreatedEventMother::fromIngredient($ingredient);

        $this->shouldSave($ingredient);
        $this->shouldPublishEvent($event);

        $this->dispatchSync($command, $this->handler);
    }
}
