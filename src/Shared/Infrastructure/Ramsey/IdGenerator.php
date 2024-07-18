<?php

namespace App\Shared\Infrastructure\Ramsey;

use Ramsey\Uuid\Uuid;
use App\Shared\Application\Service\IdGeneratorInterface;
use App\Shared\Domain\ValueObject\Id;

final class IdGenerator implements IdGeneratorInterface
{
    public function generate(): Id
    {
        return new Id(Uuid::uuid7()->toString());
    }
}
