<?php

namespace App\Shared\Domain\ValueObject;

readonly class IntegerValueObject
{
    public function __construct(protected int $value) {}

    final public function value(): int
    {
        return $this->value;
    }

    final public function equals(self $integerValueObject): bool
    {
        return ($integerValueObject->value() === $this->value);
    }
}
