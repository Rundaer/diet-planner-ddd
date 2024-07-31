<?php

namespace App\Tests\unit\DietPlanner\Recipe\Mother;

use App\DietPlanner\Recipe\Domain\ValueObject\PreparationInstructions;
use App\Tests\Utils\Shared\MotherObjects\WordMother;

class PreparationInstructionsMother
{
    public static function create(?string $value = null): PreparationInstructions
    {
        return new PreparationInstructions($value ?? WordMother::createText());
    }
}
