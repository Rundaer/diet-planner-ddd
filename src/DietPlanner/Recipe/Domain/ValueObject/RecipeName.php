<?php

namespace App\DietPlanner\Recipe\Domain\ValueObject;

use App\DietPlanner\Recipe\Domain\Exception\InvalidMealName;
use App\Shared\Domain\ValueObject\StringValueObject;

readonly class RecipeName extends StringValueObject
{
    public function __construct(string $value)
    {
        $this->validate($value);

        parent::__construct($value);
    }

    /**
     * @throws InvalidMealName
     */
    private function validate(string $value): void
    {
        if (strlen($value) < 3 || strlen($value) > 100) {
            throw new InvalidMealName();
        }
    }
}
