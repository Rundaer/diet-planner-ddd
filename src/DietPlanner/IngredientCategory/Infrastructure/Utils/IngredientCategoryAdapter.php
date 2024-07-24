<?php

namespace App\DietPlanner\IngredientCategory\Infrastructure\Utils;


use App\DietPlanner\IngredientCategory\Domain\IngredientCategory as DomainIngredientCategory;
use App\DietPlanner\IngredientCategory\Domain\ValueObject\IngredientCategoryName;
use App\DietPlanner\IngredientCategory\Infrastructure\Persistence\Doctrine\Entity\IngredientCategory as DoctrineIngredientCategory;
use App\DietPlanner\IngredientCategory\Infrastructure\Persistence\DoctrineIngredientCategoryRepository;
use App\DietPlanner\Shared\Domain\ValueObject\IngredientCategoryId;
use App\Shared\Infrastructure\Doctrine\EntityAdapterInterface;


final readonly class IngredientCategoryAdapter implements EntityAdapterInterface
{
    public function __construct(
        private DoctrineIngredientCategoryRepository $repository
    ) {}

    public function fromDomain(DomainIngredientCategory $ingredientCategory): DoctrineIngredientCategory
    {
        $entityIngredient = $this->repository->find($ingredientCategory->id);

        if ($entityIngredient === null) {
            $entityIngredient = new DoctrineIngredientCategory(
                $ingredientCategory->id->value(),
                $ingredientCategory->name->value(),
            );
        }

        return $entityIngredient;
    }

    public function toDomain(DoctrineIngredientCategory $ingredientCategory): DomainIngredientCategory
    {
        return DomainIngredientCategory::restore(
            new IngredientCategoryId($ingredientCategory->id),
            new IngredientCategoryName($ingredientCategory->name),
        );
    }
}
