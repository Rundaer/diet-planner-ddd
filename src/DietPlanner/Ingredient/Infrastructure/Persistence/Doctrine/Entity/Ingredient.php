<?php

namespace App\DietPlanner\Ingredient\Infrastructure\Persistence\Doctrine\Entity;

use App\DietPlanner\Ingredient\Domain\ValueObject\MeasurementType;
use App\DietPlanner\Ingredient\Infrastructure\Persistence\DoctrineIngredientRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Id;

#[ORM\Entity(repositoryClass: DoctrineIngredientRepository::class)]
#[ORM\Table('ingredient')]
class Ingredient
{
    public function __construct(
        #[Id]
        #[Column(type: Types::GUID)]
        private string $id,

        #[Column(type: Types::GUID)]
        private string $ingredientCategoryId,

        #[Column(type: Types::STRING, length: 255)]
        private string $title,

        #[ORM\Embedded(class: NutritionalInformation::class)]
        private NutritionalInformation $nutritionalInformation,

        #[ORM\Column(type: Types::STRING, enumType: MeasurementType::class)]
        private MeasurementType $measurementType,
    ) {}

    public function getId(): string
    {
        return $this->id;
    }

    public function getIngredientCategoryId(): string
    {
        return $this->ingredientCategoryId;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getNutritionalInformation(): NutritionalInformation
    {
        return $this->nutritionalInformation;
    }

    public function getMeasurementType(): MeasurementType
    {
        return $this->measurementType;
    }
}
