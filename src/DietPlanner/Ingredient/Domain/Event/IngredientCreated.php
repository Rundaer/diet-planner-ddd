<?php

namespace App\DietPlanner\Ingredient\Domain\Event;

use App\DietPlanner\Shared\Domain\ValueObject\IngredientId;
use App\Shared\Domain\Event\DomainEvent;
use DateTimeImmutable;
use DateTimeInterface;

final readonly class IngredientCreated extends DomainEvent
{
    public const string EVENT_NAME = 'ingredient_created';

    public const int EVENT_VERSION = 1;

    private function __construct(string $aggregateId, string $occurredAt)
    {
        parent::__construct(
            $aggregateId,
            $this->getEventName(),
            $this->getEventVersion(),
            $occurredAt
        );
    }

    public function getEventName(): string
    {
        return self::EVENT_NAME;
    }

    public function getEventVersion(): string
    {
        return self::EVENT_VERSION;
    }

    public static function create(IngredientId $ingredientId): self
    {
        return new self(
            $ingredientId->value(),
            (new DateTimeImmutable())->format(DateTimeInterface::ATOM),
        );
    }
}
