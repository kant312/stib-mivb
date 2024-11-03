<?php

declare(strict_types=1);

namespace Kant312\StibMivb\Model;

final readonly class DistanceFromPoint
{
    private function __construct(public int $value) {}

    public static function fromInt(int $value): self
    {
        return new self($value);
    }
}