<?php

declare(strict_types=1);

namespace Kant312\StibMivb\Model;

use DateTimeImmutable;

final readonly class PassingTimes
{
    private function __construct(
        public string $destinationFr,
        public string $destinationNl,
        public string $messageEn,
        public string $messageFr,
        public string $messageNl,
        public DateTimeImmutable $expectedArrivalTime,
    ) {
    }

    public static function fromJson(string $json): self
    {
        $deserialised = json_decode($json, false, 512, JSON_THROW_ON_ERROR);
        $expectedArrivalTime = DateTimeImmutable::createFromFormat(
            DateTimeImmutable::ATOM,
            $deserialised[0]->expectedArrivalTime
        );
        $expectedArrivalTime = ($expectedArrivalTime === false) ? new DateTimeImmutable() : $expectedArrivalTime;

        return new self(
            $deserialised[0]->destination->fr ?? '',
            $deserialised[0]->destination->nl ?? '',
            $deserialised[0]->message->en ?? '',
            $deserialised[0]->message->fr ?? '',
            $deserialised[0]->message->nl ?? '',
            $expectedArrivalTime,
        );
    }
}
