<?php

namespace App\Tests\Utils\Shared\MotherObjects;

final class WordMother
{
    public static function create(): string
    {
        return MotherCreator::random()->word;
    }

    public static function createText(int $chars = 200): string
    {
        return MotherCreator::random()->text($chars);
    }
}
