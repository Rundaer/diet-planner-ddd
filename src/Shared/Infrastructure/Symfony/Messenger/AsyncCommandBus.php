<?php declare(strict_types=1);

namespace App\Shared\Infrastructure\Symfony\Messenger;

use App\Shared\Application\Command\Async\Command;
use App\Shared\Application\Command\Async\CommandBus;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\MessageBusInterface;
use Throwable;

final readonly class AsyncCommandBus implements CommandBus
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
