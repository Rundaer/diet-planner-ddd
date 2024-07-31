<?php

namespace App\Tests\Utils\Shared;

use App\Shared\Application\Command\Async\Command as AsyncCommand;
use App\Shared\Application\Command\Sync\Command as SyncCommand;
use App\Shared\Application\Service\IdGeneratorInterface;
use App\Shared\Domain\Event\Event;
use App\Shared\Domain\Event\EventBusInterface;
use App\Shared\Domain\Event\EventHandlerInterface;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Mockery\MockInterface;

abstract class UnitTestCase extends MockeryTestCase
{
    private readonly EventBusInterface|MockInterface|null $eventDispatcher;
    private readonly EventHandlerInterface|MockInterface|null $eventHandler;
    private readonly IdGeneratorInterface|MockInterface|null $idGenerator;

    protected function mock(string $className): MockInterface
    {
        return Mockery::mock($className);
    }

    protected function eventBus(): EventBusInterface|MockInterface
    {
        return $this->eventDispatcher ??= $this->mock(EventBusInterface::class);
    }

    protected function eventHandler(): EventHandlerInterface|MockInterface
    {
        return $this->eventDispatcher ??= $this->mock(EventHandlerInterface::class);
    }

    protected function shouldPublishEvent(Event $domainEvent): void
    {
        $this->eventBus()
            ->shouldReceive('publish')
            ->with(Mockery::on(function ($arg) use ($domainEvent) {
                return $arg instanceof Event
                    && $arg->aggregateId === $domainEvent->aggregateId;
            }))
            ->andReturnNull();
    }

    protected function shouldNotPublishEvent(): void
    {
        $this->eventBus()
            ->shouldReceive('publish')
            ->withNoArgs()
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

    protected function notify(Event $event, callable $subscriber): void
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
