<?php

namespace App\Tests\Shared\Infrastructure\PhpUnit;

use App\Shared\Application\Command\Sync\Command as SyncCommand;
use App\Shared\Application\Service\IdGeneratorInterface;
use App\Shared\Domain\Event\Event;
use App\Shared\Domain\Event\EventBusInterface;
use Mockery;
use Mockery\Adapter\Phpunit\MockeryTestCase;
use Mockery\MockInterface;

abstract class UnitTestCase extends MockeryTestCase
{
    private readonly EventBusInterface|MockInterface|null $eventDispatcher;
    private readonly IdGeneratorInterface|MockInterface|null $idGenerator;

    protected function mock(string $className): MockInterface
    {
        return Mockery::mock($className);
    }

    protected function eventBus(): EventBusInterface|MockInterface
    {
        return $this->eventDispatcher ??= $this->mock(EventBusInterface::class);
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
}
