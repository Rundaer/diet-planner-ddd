<?php

namespace App\Tests\unit\DietPlanner\Recipe\Mother;

use App\DietPlanner\Recipe\Domain\ValueObject\ServingSize;
use App\Tests\Utils\Shared\MotherObjects\IntegerMother;

class ServingSizeMother
{
    public static function create(?int $value = null): ServingSize
    {
        return new ServingSize($value ?? IntegerMother::between(1, 100));
    }
}
