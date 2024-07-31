<?php

namespace App\Tests\Utils\Shared\MotherObjects;

final class UuidMother
{
    public static function create(): string
    {
        return MotherCreator::random()->uuid();
    }
}
