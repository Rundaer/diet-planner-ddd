<?php declare(strict_types=1);

namespace App\Shared\Domain\Event;

interface EventHandlerInterface
{
    public function handle(Event $event): void;
}
