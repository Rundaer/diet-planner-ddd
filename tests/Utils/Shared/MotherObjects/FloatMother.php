<?php

declare(strict_types=1);

namespace App\Tests\Utils\Shared\MotherObjects;

final class FloatMother
{
    public static function create(): float
    {
        return self::between(1);
    }

    public static function between(float $min, float $max = \PHP_FLOAT_MAX): float
    {
        $randomFloat = MotherCreator::random()->randomFloat(2, $min, $max);

        return \round($randomFloat, 2);
    }

    public static function lessThan(float $max): float
    {
        return self::between(1, $max);
    }
}
