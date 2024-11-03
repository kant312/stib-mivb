<?php

declare(strict_types=1);

namespace Kant312\StibMivb\Model;

final readonly class DirectionId
{
    private function __construct(public string $value) {}

    public static function fromString(string $value): self
    {
        return new self($value);
    }
}