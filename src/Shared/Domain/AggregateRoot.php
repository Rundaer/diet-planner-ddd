<?php

declare(strict_types=1);

namespace App\Shared\Domain;

use App\Shared\Domain\Event\Event;

abstract class AggregateRoot
{
    /**
     * @var Event[]
     */
    private array $events = [];

    /**
     * @return Event[]
     */
    final public function callEvents(): array
    {
        $events = $this->events;
        $this->events = [];

        return $events;
    }

    final protected function record(Event $event): void
    {
        $this->events[] = $event;
    }
}
