<?php

declare(strict_types=1);

namespace Kant\StibMivb\Exceptions;

use Exception;

final class RequestLimitExceeded extends Exception
{
    private function __construct(string $error)
    {
        parent::__construct($error);
    }

    public static function create(): self
    {
        return new self('The application exceeded the limit of allowed requests.');
    }
}
