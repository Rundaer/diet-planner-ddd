<?php

namespace App\Shared\Infrastructure\Symfony\Messenger;

use App\Shared\Application\Command\Sync\Command;
use App\Shared\Application\Command\Sync\CommandBus;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\MessageBusInterface;
use Throwable;

final readonly class SyncCommandBus implements CommandBus
{
    public function __construct(
        private MessageBusInterface $commandBus
    ) {}

    /**
     * @throws Throwable
     */
    public function dispatch(Command $command): void
    {
        try {
            $this->commandBus->dispatch($command);
        } catch (HandlerFailedException $exception) {
            throw $exception->getPrevious() ?? $exception;
        }
    }
}
