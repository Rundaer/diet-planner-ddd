<?php

namespace App\DietPlanner\Ingredient\Infrastructure\Persistence;

use App\DietPlanner\Ingredient\Infrastructure\Persistence\Doctrine\Entity\Ingredient as EntityIngredient;
use App\DietPlanner\Shared\Domain\ValueObject\IngredientId;
use Doctrine\ORM\EntityManagerInterface;

readonly class IngredientRepository
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {
    }

    public function save(EntityIngredient $ingredient): void
    {
        $this->entityManager->persist($ingredient);
        $this->entityManager->flush();
    }

    public function find(IngredientId $id): ?EntityIngredient
    {
        $qb = $this->entityManager->createQueryBuilder();

        return $qb
            ->select('i')
            ->from(EntityIngredient::class, 'i')
            ->where('i.id = :id')
            ->setParameter(':id', $id->value())
            ->getQuery()
            ->getOneOrNullResult();
    }
}
