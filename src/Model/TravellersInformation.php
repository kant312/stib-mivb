<?php

declare(strict_types=1);

namespace Kant312\StibMivb\Model;

use stdClass;

final readonly class TravellersInformation
{
    /**
     * @param LineID[] $lines
     * @param PointID[] $points
     */
    private function __construct(
        public Priority $priority,
        public TravellersInformationDescription $description,
        public array $lines,
        public array $points,
    ) {
    }

    public static function fromObject(stdClass $data): self
    {
        $lines = json_decode($data->lines, false, 5, JSON_THROW_ON_ERROR);
        $lines = array_map(fn ($line) => LineID::fromString($line->id), $lines);
        $points = json_decode($data->points, false, 5, JSON_THROW_ON_ERROR);
        $points = array_map(fn ($point) => PointID::fromInt((int) $point->id), $points);

        return new self(
            Priority::fromInt($data->priority),
            TravellersInformationDescription::fromJson($data->content),
            $lines,
            $points,
        );
    }
}
