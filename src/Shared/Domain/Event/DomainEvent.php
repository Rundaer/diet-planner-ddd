<?php declare(strict_types=1);

namespace App\Shared\Domain\Event;

abstract readonly class DomainEvent
{
    public function __construct(
        public string $aggregateId,
        public string $name,
        public int $version,
        public string $occurredAt
    ) {}

    abstract public function getEventName(): string;

    abstract public function getEventVersion(): string;
}
