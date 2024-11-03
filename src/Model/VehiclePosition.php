<?php

declare(strict_types=1);

namespace Kant312\StibMivb\Model;

final readonly class VehiclePosition
{
    private function __construct(
        public DirectionId $directionId,
        public DistanceFromPoint $distanceFromPoint,
        public PointID $pointId,
    )
    {
    }

    public static function fromObject(mixed $vehiclePosition): self
    {
        return new self(
            DirectionId::fromString($vehiclePosition->directionId),
            DistanceFromPoint::fromInt($vehiclePosition->distanceFromPoint),
            PointID::fromInt((int) $vehiclePosition->pointId),
        );
    }
}