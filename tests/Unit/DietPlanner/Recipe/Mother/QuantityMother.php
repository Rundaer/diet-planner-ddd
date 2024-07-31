<?php

namespace App\Tests\unit\DietPlanner\Recipe\Mother;

use App\DietPlanner\Recipe\Domain\ValueObject\Quantity;
use App\Tests\Utils\Shared\MotherObjects\IntegerMother;

class QuantityMother
{
    public static function create(): Quantity
    {
        return new Quantity(IntegerMother::between(1, 10));
    }
}
