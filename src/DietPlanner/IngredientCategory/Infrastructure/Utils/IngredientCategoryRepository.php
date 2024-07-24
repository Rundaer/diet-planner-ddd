<?php

namespace App\DietPlanner\Ingredient\Infrastructure\Utils;

use App\DietPlanner\Ingredient\Domain\Exception\IngredientNotFound;
use App\DietPlanner\Ingredient\Domain\Ingredient as DomainIngredient;
use App\DietPlanner\Ingredient\Domain\IngredientRepositoryInterface;
use App\DietPlanner\Ingredient\Infrastructure\Persistence\DoctrineIngredientCategoryRepository;
use App\DietPlanner\Shared\Domain\ValueObject\IngredientId;

readonly class IngredientCategoryRepository implements IngredientRepositoryInterface
{
    public function __construct(
        private DoctrineIngredientCategoryRepository $repository,
        private IngredientCategoryAdapter            $adapter,
    ) {
    }

    public function save(DomainIngredient $ingredient): void
    {
        $this->repository->save(
            $this->adapter->fromDomain($ingredient)
        );
    }

    public function find(IngredientId $id): ?DomainIngredient
    {
        $entity = $this->repository->find($id);

        if ($entity === null) {
            throw new IngredientNotFound();
        }

        return $this->adapter->toDomain($entity);
    }
}
