<?php

namespace App\DietPlanner\Ingredient\Infrastructure\Persistence;

use App\DietPlanner\Ingredient\Infrastructure\Persistence\Doctrine\Entity\Ingredient as DoctrineIngredient;
use App\DietPlanner\Shared\Domain\ValueObject\IngredientId;
use Doctrine\ORM\EntityManagerInterface;

readonly class DoctrineIngredientRepository
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {
    }

    public function save(DoctrineIngredient $ingredient): void
    {
        $this->entityManager->persist($ingredient);
        $this->entityManager->flush();
    }

    public function find(IngredientId $id): ?DoctrineIngredient
    {
        $qb = $this->entityManager->createQueryBuilder();

        return $qb
            ->select('i')
            ->from(DoctrineIngredient::class, 'i')
            ->where('i.id = :id')
            ->setParameter(':id', $id->value())
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param array<IngredientId> $ids
     */
    public function findMultiple(array $ids): array
    {
        $preparedIds = array_map(function (IngredientId $id) {
            return $id->value();
        }, $ids);

        $qb = $this->entityManager->createQueryBuilder();

        return $qb
            ->select('i.id')
            ->where('i.id IN (:ids)')
            ->setParameter('ids', $preparedIds)
            ->getQuery()
            ->getArrayResult();
    }
}
