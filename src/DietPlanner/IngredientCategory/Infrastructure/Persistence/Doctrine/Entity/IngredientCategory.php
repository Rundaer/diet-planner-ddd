<?php

namespace App\DietPlanner\IngredientCategory\Infrastructure\Persistence\Doctrine\Entity;

use App\DietPlanner\IngredientCategory\Infrastructure\Persistence\DoctrineIngredientCategoryRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Id;

#[ORM\Entity(repositoryClass: DoctrineIngredientCategoryRepository::class)]
#[ORM\Table('ingredient_category')]
readonly class IngredientCategory
{
    public function __construct(
        #[Id]
        #[Column(type: Types::GUID)]
        public string $id,

        #[Column(type: Types::STRING, length: 255)]
        public string $name,
    ) {}
}
