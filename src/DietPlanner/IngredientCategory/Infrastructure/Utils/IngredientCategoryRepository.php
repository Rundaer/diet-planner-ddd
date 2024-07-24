<?php

namespace App\DietPlanner\IngredientCategory\Infrastructure\Utils;

use App\DietPlanner\IngredientCategory\Domain\Exception\IngredientCategoryNotFound;
use App\DietPlanner\IngredientCategory\Domain\IngredientCategory as DomainIngredientCategory;
use App\DietPlanner\IngredientCategory\Domain\IngredientCategoryInterface;
use App\DietPlanner\IngredientCategory\Infrastructure\Persistence\DoctrineIngredientCategoryRepository;
use App\DietPlanner\Shared\Domain\Services\IngredientCategoryValidatorInterface;
use App\DietPlanner\Shared\Domain\ValueObject\IngredientCategoryId;

readonly class IngredientCategoryRepository implements IngredientCategoryInterface, IngredientCategoryValidatorInterface
{
    public function __construct(
        private DoctrineIngredientCategoryRepository $repository,
        private IngredientCategoryAdapter $adapter,
    ) {
    }

    public function save(DomainIngredientCategory $category): void
    {
        $this->repository->save(
            $this->adapter->fromDomain($category)
        );
    }

    public function find(IngredientCategoryId $id): ?DomainIngredientCategory
    {
        $entity = $this->repository->find($id);

        if ($entity === null) {
            throw new IngredientCategoryNotFound();
        }

        return $this->adapter->toDomain($entity);
    }

    public function exists(IngredientCategoryId $id): bool
    {
        $category = $this->repository->find($id);

        return $category !== null;
    }
}
