<?php

declare(strict_types=1);

namespace Kant\StibMivb;

final readonly class Priority
{
    private function __construct(
        public int $priority
    ) {
    }

    public static function fromInt(int $priority): self
    {
        return new self($priority);
    }
}
