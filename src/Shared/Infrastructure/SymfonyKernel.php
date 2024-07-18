<?php

namespace App\Shared\Infrastructure;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

class SymfonyKernel extends BaseKernel
{
    use MicroKernelTrait;
}
