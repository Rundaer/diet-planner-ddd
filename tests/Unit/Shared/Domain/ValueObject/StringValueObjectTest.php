<?php

namespace App\Tests\Unit\Shared\Domain\ValueObject;

use App\Shared\Domain\ValueObject\StringValueObject;
use App\Tests\Utils\Shared\UnitTestCase;
use PHPUnit\Framework\Attributes\Test;

class StringValueObjectTest extends UnitTestCase
{
    #[Test]
    public function itShouldReturnCorrectStringValue(): void
    {
        $value = 'test string';
        $stringValueObject = new StringValueObject($value);

        $this->assertEquals($value, $stringValueObject->value());
    }

    #[Test]
    public function itShouldReturnTrueForEqualObjects(): void
    {
        $value = 'test string';
        $object1 = new StringValueObject($value);
        $object2 = new StringValueObject($value);

        $this->assertTrue($object1->equals($object2));
    }

    #[Test]
    public function itShouldReturnFalseForDifferentObjects(): void
    {
        $object1 = new StringValueObject('test string 1');
        $object2 = new StringValueObject('test string 2');

        $this->assertFalse($object1->equals($object2));
    }
}
