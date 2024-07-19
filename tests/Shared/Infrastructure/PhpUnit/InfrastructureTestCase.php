<?php

namespace App\Tests\Shared\Infrastructure\PhpUnit;


use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

abstract class InfrastructureTestCase extends KernelTestCase
{
    protected function service(string $id): mixed
    {
        return self::getContainer()->get($id);
    }
}
