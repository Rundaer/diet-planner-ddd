<?php

namespace App\DietPlanner\Ingredient\Domain\Exception;

use App\Shared\Domain\Exception\DomainException;

class InvalidMeasurementType extends DomainException
{
    public function __construct(string $type)
    {
        $message = sprintf('Measurement type does not exists %s', $type);

        parent::__construct($message);
    }
}
