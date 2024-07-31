<?php

namespace App\DietPlanner\Recipe\Domain\ValueObject;

use App\DietPlanner\Recipe\Domain\Exception\InvalidServingSize;
use App\Shared\Domain\ValueObject\IntegerValueObject;

readonly class ServingSize extends IntegerValueObject
{
    private const int MIN_SERVINGS = 1;
    private const int MAX_SERVINGS = 100;

    public function __construct($value)
    {
        $this->validate($value);

        parent::__construct($value);
    }

    private function validate(int $value): void
    {
        if ($value < self::MIN_SERVINGS || $value > self::MAX_SERVINGS) {
            throw new InvalidServingSize(
                sprintf('Serving size must be between %d and %d.', self::MIN_SERVINGS, self::MAX_SERVINGS)
            );
        }
    }
}
