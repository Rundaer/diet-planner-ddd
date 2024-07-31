<?php

namespace App\Tests\Unit\Shared\Domain\ValueObject;

use App\Shared\Domain\ValueObject\IntegerValueObject;
use App\Tests\Utils\Shared\UnitTestCase;
use PHPUnit\Framework\Attributes\Test;

class IntegerValueObjectTest extends UnitTestCase
{
    #[Test]
    public function itShouldReturnCorrectIntegerValue(): void
    {
        $value = 42;
        $integerValueObject = new IntegerValueObject($value);

        $this->assertEquals($value, $integerValueObject->value());
    }

    #[Test]
    public function itShouldReturnTrueForEqualObjects(): void
    {
        $value = 42;
        $object1 = new IntegerValueObject($value);
        $object2 = new IntegerValueObject($value);

        $this->assertTrue($object1->equals($object2));
    }

    #[Test]
    public function itShouldReturnFalseForDifferentObjects(): void
    {
        $object1 = new IntegerValueObject(42);
        $object2 = new IntegerValueObject(24);

        $this->assertFalse($object1->equals($object2));
    }
}
