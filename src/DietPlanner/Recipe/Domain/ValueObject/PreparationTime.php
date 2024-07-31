<?php

namespace App\DietPlanner\Recipe\Domain\ValueObject;

use App\DietPlanner\Recipe\Domain\Exception\InvalidPreparationTime;

class PreparationTime
{
    private const int MIN_MINUTES = 1;
    private const int MAX_MINUTES = 1440; // 24 hours

    public function __construct(private readonly int $minutes)
    {
        $this->validate($minutes);
    }

    public static function fromMinutes(int $minutes): self
    {
        return new self($minutes);
    }

    private function validate(int $minutes): void
    {
        if ($minutes < self::MIN_MINUTES || $minutes > self::MAX_MINUTES) {
            throw new InvalidPreparationTime(
                sprintf('Preparation time must be between %d and %d minutes.', self::MIN_MINUTES, self::MAX_MINUTES)
            );
        }
    }

    public function minutes(): int
    {
        return $this->minutes;
    }

    public function hours(): float
    {
        return $this->minutes / 60;
    }

    public function __toString(): string
    {
        $hours = floor($this->minutes / 60);
        $remainingMinutes = $this->minutes % 60;

        if ($hours > 0) {
            return sprintf('%d hour%s %d minute%s',
                $hours, $hours > 1 ? 's' : '',
                $remainingMinutes, $remainingMinutes != 1 ? 's' : ''
            );
        }

        return sprintf('%d minute%s', $this->minutes, $this->minutes != 1 ? 's' : '');
    }
}
