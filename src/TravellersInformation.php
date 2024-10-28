<?php

declare(strict_types=1);

namespace Kant\StibMivb;

use stdClass;

final readonly class TravellersInformation
{
    /**
     * @param LineId[] $lines
     * @param int[] $points
     */
    private function __construct(
        public Priority $priority,
        public array $lines,
        public array $points,
        public TravellersInformationDescription $description,
    ) {
    }

    public static function fromObject(stdClass $data): self
    {
        $lines = json_decode($data->lines, false, 5, JSON_THROW_ON_ERROR);
        $lines = array_map(fn ($line) => LineId::fromString($line->id), $lines);
        $points = json_decode($data->points, false, 5, JSON_THROW_ON_ERROR);
        $points = array_map(fn ($point) => (int) $point->id, $points);

        return new self(
            Priority::fromInt($data->priority),
            $lines,
            $points,
            TravellersInformationDescription::fromJson($data->content),
        );
    }
}
