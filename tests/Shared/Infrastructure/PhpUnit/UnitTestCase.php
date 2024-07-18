<?php

namespace App\Tests\Shared\Infrastructure\PhpUnit;

use App\Shared\Application\Command\Sync\Command as SyncCommand;
use App\Shared\Application\Command\Async\Command as AsyncCommand;
use App\Shared\Application\Service\IdGeneratorInterface;
use App\Shared\Domain\Event\DomainEvent;
use App\Shared\Domain\Event\DomainEventDispatcherInterface;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Mockery\MockInterface;

abstract class UnitTestCase extends MockeryTestCase
{
    private readonly DomainEventDispatcherInterface|MockInterface|null $eventDispatcher;
    private readonly IdGeneratorInterface|MockInterface|null $idGenerator;

    protected function mock(string $className): MockInterface
    {
        return Mockery::mock($className);
    }

    protected function eventDispatcher(): DomainEventDispatcherInterface|MockInterface
    {
        return $this->eventDispatcher ??= $this->mock(DomainEventDispatcherInterface::class);
    }

    protected function shouldDispatchDomainEvent(DomainEvent $domainEvent): void
    {
        $this->eventDispatcher()
            ->shouldReceive('dispatch')
            ->with(Mockery::on(function ($arg) use ($domainEvent) {
                return $arg instanceof DomainEvent
                    && $arg->aggregateId === $domainEvent->aggregateId;
            }))
            ->andReturnNull();
    }

    protected function shouldGenerateUuid(string $uuid): void
    {
        $this->idGenerator()
            ->shouldReceive('generate')
            ->once()
            ->withNoArgs()
            ->andReturn($uuid);
    }

    protected function idGenerator(): MockInterface|IdGeneratorInterface
    {
        return $this->idGenerator ??= $this->mock(IdGeneratorInterface::class);
    }

    protected function notify(DomainEvent $event, callable $subscriber): void
    {
        $subscriber($event);
    }

    protected function dispatchSync(SyncCommand $command, callable $commandHandler): void
    {
        $commandHandler($command);
    }

    protected function dispatchAsync(AsyncCommand $command, callable $commandHandler): void
    {
        $commandHandler($command);
    }
}
