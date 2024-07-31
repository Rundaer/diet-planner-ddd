<?php

namespace App\Tests\unit\DietPlanner\Recipe\Domain;

use App\DietPlanner\Recipe\Domain\Exception\InvalidPreparationInstructions;
use App\DietPlanner\Recipe\Domain\ValueObject\PreparationInstructions;
use App\Tests\unit\DietPlanner\Recipe\RecipeModuleUnitTestCase;
use PHPUnit\Framework\Attributes\Test;

class PreparationInstructionsTest extends RecipeModuleUnitTestCase
{
    #[Test]
    public function itShouldCreateValidPreparationInstructions()
    {
        $instructions = "Boil water. Add pasta. Cook for 10 minutes. Drain and serve.";
        $prepInstructions = new PreparationInstructions($instructions);

        $this->assertEquals($instructions, $prepInstructions->value());
    }

    #[Test]
    public function itShouldThrowExceptionForTooShortInstructions()
    {
        $this->expectException(InvalidPreparationInstructions::class);
        new PreparationInstructions("Too short");
    }

    #[Test]
    public function itShouldThrowExceptionForTooLongInstructions()
    {
        $this->expectException(InvalidPreparationInstructions::class);
        new PreparationInstructions(\str_repeat("a", 5001));
    }

    #[Test]
    public function itShouldAllowMinimumLengthInstructions()
    {
        $minLengthInstructions = \str_repeat("a", 10);
        $prepInstructions = new PreparationInstructions($minLengthInstructions);

        $this->assertEquals($minLengthInstructions, $prepInstructions->value());
    }

    #[Test]
    public function itShouldAllowMaximumLengthInstructions()
    {
        $maxLengthInstructions = \str_repeat("a", 5000);
        $prepInstructions = new PreparationInstructions($maxLengthInstructions);

        $this->assertEquals($maxLengthInstructions, $prepInstructions->value());
    }

    #[Test]
    public function itShouldPreserveWhitespaceAndNewlines()
    {
        $instructions = "Step 1: Do this.\nStep 2: Do that.\n\nStep 3: Finish.";
        $prepInstructions = new PreparationInstructions($instructions);

        $this->assertEquals($instructions, $prepInstructions->value());
    }
}
