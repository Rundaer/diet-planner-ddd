<?php

namespace App\DietPlanner\IngredientCategory\Infrastructure\Persistence;

use App\DietPlanner\IngredientCategory\Infrastructure\Persistence\Doctrine\Entity\IngredientCategory as EntityIngredientCategory;
use App\DietPlanner\Shared\Domain\ValueObject\IngredientCategoryId;
use Doctrine\ORM\EntityManagerInterface;

readonly class DoctrineIngredientCategoryRepository
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {
    }

    public function save(EntityIngredientCategory $ingredient): void
    {
        $this->entityManager->persist($ingredient);
        $this->entityManager->flush();
    }

    public function find(IngredientCategoryId $id): ?EntityIngredientCategory
    {
        $qb = $this->entityManager->createQueryBuilder();

        return $qb
            ->select('i')
            ->from(EntityIngredientCategory::class, 'i')
            ->where('i.id = :id')
            ->setParameter(':id', $id->value())
            ->getQuery()
            ->getOneOrNullResult();
    }
}
