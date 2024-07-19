<?php

namespace App\DietPlanner\Ingredient\Infrastructure\Persistence\Doctrine\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
readonly class NutritionalInformation
{
    public function __construct(
        #[ORM\Column(name: 'calories', type: Types::FLOAT, nullable: false, options: ['default' => 0.0])]
        private float $calories = 0.0,

        #[ORM\Column(name: 'protein', type: Types::FLOAT, nullable: false, options: ['default' => 0.0])]
        private float $protein = 0.0,

        #[ORM\Column(name: 'carbohydrates', type: Types::FLOAT, nullable: false, options: ['default' => 0.0])]
        private float $carbohydrates = 0.0,

        #[ORM\Column(name: 'fats', type: Types::FLOAT, nullable: false, options: ['default' => 0.0])]
        private float $fats = 0.0,
    ) {}

    public static function fromArray(array $nutritionalInformationArray): self
    {
        return new self(
            (float) $nutritionalInformationArray['calories'],
            (float) $nutritionalInformationArray['protein'],
            (float) $nutritionalInformationArray['carbohydrates'],
            (float) $nutritionalInformationArray['fats'],
        );
    }

    public function toArray(): array
    {
        return [
            'calories' => $this->calories,
            'protein' => $this->protein,
            'carbohydrates' => $this->carbohydrates,
            'fats' => $this->fats,
        ];
    }
}
