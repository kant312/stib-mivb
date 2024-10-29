<?php

declare(strict_types=1);

namespace Kant312\StibMivb\Model;
final readonly class Point
{
    private function __construct(public int $point)
    {
    }

    public static function fromInt(int $point): self
    {
        return new self($point);
    }
}