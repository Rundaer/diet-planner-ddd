<?php

namespace App\Tests\Unit\Shared\Domain\ValueObject;

use App\Shared\Domain\Exception\InvalidId;
use App\Shared\Domain\ValueObject\Id;
use App\Tests\Utils\Shared\UnitTestCase;
use PHPUnit\Framework\Attributes\Test;

class IdTest extends UnitTestCase
{
    #[Test]
    public function itShouldCreateValidId(): void
    {
        $validId = '550e8400-e29b-41d4-a716-446655440000';
        $id = new Id($validId);

        $this->assertEquals($validId, $id->value());
    }

    #[Test]
    public function itShouldThrowExceptionForInvalidId(): void
    {
        $this->expectException(InvalidId::class);

        new Id('invalid-id-format');
    }

    #[Test]
    public function itShouldReturnTrueForEqualIds(): void
    {
        $idString = '550e8400-e29b-41d4-a716-446655440000';
        $id1 = new Id($idString);
        $id2 = new Id($idString);

        $this->assertTrue($id1->equals($id2));
    }

    #[Test]
    public function itShouldReturnFalseForDifferentIds(): void
    {
        $id1 = new Id('550e8400-e29b-41d4-a716-446655440000');
        $id2 = new Id('650e8400-e29b-41d4-a716-446655440000');

        $this->assertFalse($id1->equals($id2));
    }
}
