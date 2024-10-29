<?php

declare(strict_types=1);

namespace Kant312\StibMivb\Model;

final readonly class LineId
{
    private function __construct(
        public string $lineId,
    ) {
    }

    public static function fromString(string $lineId): self
    {
        return new self($lineId);
    }
}
