<?php

namespace App\DietPlanner\Recipe\Domain\ValueObject;

class RecipeIngredientsCollection
{
    /**
     * @param array<int, RecipeIngredient> $recipeIngredients
     */
    private function __construct(
        private array $recipeIngredients = []
    ) {
        $this->reindexIngredients();
    }

    public static function create(RecipeIngredient ...$ingredients): self
    {
        return new self($ingredients);
    }

    public function add(RecipeIngredient $ingredient, ?int $position = null): void
    {
        if ($position === null || $position > count($this->recipeIngredients)) {
            $this->recipeIngredients[] = $ingredient;
        } else {
            array_splice($this->recipeIngredients, $position - 1, 0, [$ingredient]);
        }

        $this->reindexIngredients();
    }

    public function remove(int $position): void
    {
        if ($position >= 1 && $position <= count($this->recipeIngredients)) {
            array_splice($this->recipeIngredients, $position - 1, 1);
            $this->reindexIngredients();
        }
    }

    /** @return array<int, RecipeIngredient> */
    public function getAll(): array
    {
        return $this->recipeIngredients;
    }

    public function count(): int
    {
        return count($this->recipeIngredients);
    }

    private function reindexIngredients(): void
    {
        $this->recipeIngredients = array_combine(
            range(1, count($this->recipeIngredients)),
            array_values($this->recipeIngredients)
        );
    }
}
