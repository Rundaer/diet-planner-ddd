<?php

namespace App\Shared\Domain\ValueObject;

readonly class StringValueObject
{
    public function __construct(protected string $value) {}

    final public function value(): string
    {
        return $this->value;
    }

    final public function equals(self $stringValueObject): bool
    {
        return ($stringValueObject->value() === $this->value);
    }
}
