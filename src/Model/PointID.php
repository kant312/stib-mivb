<?php

declare(strict_types=1);

namespace Kant312\StibMivb\Model;
final readonly class PointID
{
    private function __construct(public int $pointId)
    {
    }

    public static function fromInt(int $pointId): self
    {
        return new self($pointId);
    }
}