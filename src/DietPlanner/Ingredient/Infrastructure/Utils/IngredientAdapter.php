<?php

namespace App\DietPlanner\Ingredient\Infrastructure\Utils;

use App\DietPlanner\Ingredient\Domain\Ingredient as DomainIngredient;
use App\DietPlanner\Ingredient\Domain\ValueObject\IngredientTitle;
use App\DietPlanner\Ingredient\Domain\ValueObject\NutritionalInformation as DomainNutritionalInformation;
use App\DietPlanner\Ingredient\Infrastructure\Persistence\Doctrine\Entity\Ingredient as EntityIngredient;
use App\DietPlanner\Ingredient\Infrastructure\Persistence\Doctrine\Entity\NutritionalInformation as EntityNutritionalInformation;
use App\DietPlanner\Shared\Domain\ValueObject\IngredientCategoryId;
use App\DietPlanner\Shared\Domain\ValueObject\IngredientId;
use App\Shared\Infrastructure\Doctrine\EntityAdapterInterface;
use App\DietPlanner\Ingredient\Infrastructure\Persistence\IngredientRepository as DoctrineIngredientRepository;

final readonly class IngredientAdapter implements EntityAdapterInterface
{
    public function __construct(
        private DoctrineIngredientRepository $repository
    ) {}

    public function fromDomain(DomainIngredient $ingredient): EntityIngredient
    {
        $entityIngredient = $this->repository->find($ingredient->ingredientId);

        if ($entityIngredient === null) {
            $entityIngredient = new EntityIngredient(
                $ingredient->ingredientId->value(),
                $ingredient->ingredientCategoryId->value(),
                $ingredient->title->value(),
                new EntityNutritionalInformation(...$ingredient->nutritionalInformation->toArray()),
                $ingredient->measurementType
            );
        }

        return $entityIngredient;
    }

    public function toDomain(EntityIngredient $ingredient): DomainIngredient
    {
        return DomainIngredient::restore(
            new IngredientId($ingredient->getId()),
            new IngredientCategoryId($ingredient->getIngredientCategoryId()),
            new IngredientTitle($ingredient->getTitle()),
            DomainNutritionalInformation::fromArray($ingredient->getNutritionalInformation()->toArray()),
            $ingredient->getMeasurementType()
        );
    }
}
