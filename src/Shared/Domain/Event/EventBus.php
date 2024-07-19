<?php declare(strict_types=1);

namespace App\Shared\Domain\Event;

final class EventBus implements EventBusInterface
{
    /**
     * @var EventHandlerInterface[]
     */
    private array $handlers;

    /**
     * @param EventHandlerInterface[] $listeners
     */
    public function __construct(iterable $listeners)
    {
        foreach ($listeners as $listener) {
            $this->handlers[] = $listener;
        }
    }

    public function publish(Event ...$events): void
    {
        foreach ($events as $event) {
            foreach ($this->handlers as $listener) {
                $listener->handle($event);
            }
        }
    }
}
