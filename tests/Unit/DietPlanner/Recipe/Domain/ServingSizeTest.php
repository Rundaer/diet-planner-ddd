<?php

namespace App\Tests\unit\DietPlanner\Recipe\Domain;

use App\DietPlanner\Recipe\Domain\Exception\InvalidServingSize;
use App\DietPlanner\Recipe\Domain\ValueObject\ServingSize;
use App\Tests\unit\DietPlanner\Recipe\RecipeModuleUnitTestCase;
use PHPUnit\Framework\Attributes\Test;

class ServingSizeTest extends RecipeModuleUnitTestCase
{
    #[Test]
    public function itShouldCreateValidServingSize()
    {
        $servingSize = new ServingSize(4);

        $this->assertEquals(4, $servingSize->value());
    }

    #[Test]
    public function itShouldThrowExceptionForTooSmallServingSize()
    {
        $this->expectException(InvalidServingSize::class);
        new ServingSize(0);
    }

    #[Test]
    public function itShouldThrowExceptionForTooBigServingSize()
    {
        $this->expectException(InvalidServingSize::class);
        new ServingSize(101);
    }

    #[Test]
    public function itShouldAllowMinimumServingSize()
    {
        $servingSize = new ServingSize(1);

        $this->assertEquals(1, $servingSize->value());
    }

    #[Test]
    public function itShouldAllowMaximumServingSize()
    {
        $servingSize = new ServingSize(100);

        $this->assertEquals(100, $servingSize->value());
    }
}
