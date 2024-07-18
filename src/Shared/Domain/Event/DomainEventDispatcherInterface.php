<?php declare(strict_types=1);

namespace App\Shared\Domain\Event;

interface DomainEventDispatcherInterface
{
    public function dispatch(DomainEvent ...$domainEvents): void;
}
