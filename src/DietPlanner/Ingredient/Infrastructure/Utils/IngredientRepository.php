<?php

namespace App\DietPlanner\Ingredient\Infrastructure\Utils;

use App\DietPlanner\Ingredient\Domain\Exception\IngredientNotFound;
use App\DietPlanner\Ingredient\Domain\Ingredient as DomainIngredient;
use App\DietPlanner\Ingredient\Domain\Repository\IngredientRepositoryInterface;
use App\DietPlanner\Ingredient\Infrastructure\Persistence\IngredientRepository as DoctrineIngredientRepository;
use App\DietPlanner\Shared\Domain\ValueObject\IngredientId;

readonly class IngredientRepository implements IngredientRepositoryInterface
{
    public function __construct(
        private DoctrineIngredientRepository $repository,
        private IngredientAdapter $adapter,
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

        return $entity === null ? throw new IngredientNotFound() : $this->adapter->toDomain($entity);
    }
}
