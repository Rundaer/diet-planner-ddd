<?php

namespace App\Tests\unit\DietPlanner\Recipe\Mother;

use App\DietPlanner\Recipe\Domain\ValueObject\PreparationTime;
use App\Tests\Utils\Shared\MotherObjects\IntegerMother;

class PreparationTimeMother
{
    public static function create(?int $value = null): PreparationTime
    {
        return new PreparationTime($value ?? IntegerMother::between(5, 60));
    }
}
