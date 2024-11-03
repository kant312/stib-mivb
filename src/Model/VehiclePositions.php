<?php

declare(strict_types=1);

namespace Kant312\StibMivb\Model;

use stdClass;

final readonly class VehiclePositions
{
    /**
     * @param VehiclePosition[] $vehiclePositions
     */
    private function __construct(
        public LineID $lineID,
        public array $vehiclePositions
    )
    {}

    public static function fromObject(stdClass $object): self
    {
        $deserialisedVehiclePositions = json_decode(
            $object->vehiclepositions ?? '[]',
            false,
            5,
            JSON_THROW_ON_ERROR
        );

        return new self(
            LineID::fromString($object->lineid),
            array_map(
                fn (stdClass $vehiclePosition) => VehiclePosition::fromObject($vehiclePosition),
                $deserialisedVehiclePositions
            ),
        );
    }
}