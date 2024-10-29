<?php

declare(strict_types=1);

namespace Kant312\StibMivb\Model;
use stdClass;

final readonly class WaitingTime
{
    private function __construct(
        public PointID $pointID,
        public LineID $lineID,
        public PassingTimes $passingTimes,
    )
    {
    }

    public static function fromObject(stdClass $data): self
    {
        return new self(
            PointID::fromInt((int) $data->pointid),
            LineID::fromString($data->lineid),
            PassingTimes::fromJson($data->passingtimes),
        );
    }
}