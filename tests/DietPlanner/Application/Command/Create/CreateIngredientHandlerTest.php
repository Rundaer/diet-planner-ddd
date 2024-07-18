<?php

namespace App\Tests\DietPlanner\Application\Command\Create;

use App\DietPlanner\Ingredient\Application\Command\Create\CreateIngredientHandler;
use App\Tests\DietPlanner\Domain\IngredientCreatedDomainEventMother;
use App\Tests\DietPlanner\Domain\IngredientMother;
use App\Tests\DietPlanner\Ingredient\IngredientModuleUnitTestCase;

class CreateIngredientHandlerTest extends IngredientModuleUnitTestCase
{
    private CreateIngredientHandler|null $handler;

    protected function setUp(): void
    {
        parent::setUp();

        $this->handler = new CreateIngredientHandler(
            $this->repository(),
            $this->eventDispatcher(),
            $this->idGenerator()
        );
    }

    public function testItShouldCreateIngredient(): void
    {
        $command = CreateIngredientCommandMother::create();

        $ingredient = IngredientMother::fromRequest($command);
        $domainEvent = IngredientCreatedDomainEventMother::fromIngredient($ingredient);

        $this->shouldSave($ingredient);
        $this->shouldDispatchDomainEvent($domainEvent);

        $this->dispatchSync($command, $this->handler);
    }
}
