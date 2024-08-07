<?php

namespace App\DietPlanner\Ingredient\Infrastructure\Utils;

use App\DietPlanner\Ingredient\Domain\Exception\IngredientNotFound;
use App\DietPlanner\Ingredient\Domain\Ingredient as DomainIngredient;
use App\DietPlanner\Ingredient\Domain\IngredientRepositoryInterface;
use App\DietPlanner\Ingredient\Infrastructure\Persistence\Doctrine\Entity\Ingredient as DoctrineIngredient;
use App\DietPlanner\Ingredient\Infrastructure\Persistence\DoctrineIngredientRepository;
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

    public function find(IngredientId $id): DomainIngredient
    {
        $entity = $this->repository->find($id);

        if ($entity === null) {
            throw new IngredientNotFound();
        }

        return $this->adapter->toDomain($entity);
    }

    /**
     * @param array<IngredientId> $ids
     * @return array<DomainIngredient>
     */
    public function findMultiple(array $ids): array
    {
        $entities = $this->repository->findMultiple($ids);

        return array_map(function (DoctrineIngredient $ingredient) {
            $this->adapter->toDomain($ingredient);
        }, $entities);
    }
}
