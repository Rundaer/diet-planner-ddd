<?php

namespace App\DietPlanner\Recipe\Domain\ValueObject;

use App\DietPlanner\Recipe\Domain\Exception\InvalidPreparationInstructions;
use App\Shared\Domain\ValueObject\StringValueObject;

readonly class PreparationInstructions extends StringValueObject
{
    private const int MIN_LENGTH = 10;
    private const int MAX_LENGTH = 5000;

    public function __construct($value)
    {
        $this->validate($value);

        parent::__construct($value);
    }

    private function validate(string $value): void
    {
        $length = mb_strlen($value);
        if ($length < self::MIN_LENGTH || $length > self::MAX_LENGTH) {
            throw new InvalidPreparationInstructions(
                sprintf('Preparation instructions must be between %d and %d characters.', self::MIN_LENGTH, self::MAX_LENGTH)
            );
        }
    }
}
