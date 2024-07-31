<?php

namespace App\DietPlanner\Recipe\Domain\ValueObject;

enum RecipeMealType: string
{
    case BREAKFAST = 'breakfast';
    case LUNCH = 'lunch';
    case DINNER = 'dinner';
    case SNACK = 'snack';
}
