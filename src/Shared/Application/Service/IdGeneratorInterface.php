<?php

namespace App\Shared\Application\Service;

use App\Shared\Domain\ValueObject\Id;

interface IdGeneratorInterface
{
    public function generate(): Id;
}
