<?php

namespace App\DietPlanner\Ingredient\Domain\ValueObject;

final readonly class NutritionalInformation
{
    private function __construct(
        public float $calories,
        public float $protein,
        public float $carbohydrates,
        public float $fats,
    ) {}

    public function toArray(): array
    {
        return [
            'calories' => $this->calories,
            'protein' => $this->protein,
            'carbohydrates' => $this->carbohydrates,
            'fats' => $this->fats,
        ];
    }

    public static function fromArray(array $nutrients = []): self
    {
        $default = [
            'calories' => 0.0,
            'protein' => 0.0,
            'carbohydrates' => 0.0,
            'fats' => 0.0,
        ];

        $nutrients = array_merge($default, $nutrients);

        return new self(...$nutrients);
    }

    public function equals(self $nutritionalInformation): bool
    {
        return $nutritionalInformation->toArray() === $this->toArray();
    }
}
