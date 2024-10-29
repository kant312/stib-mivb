<?php

declare(strict_types=1);

namespace Kant312\StibMivb\Model;

final readonly class TravellersInformationDescription
{
    private function __construct(
        public string $english,
        public string $french,
        public string $dutch,
    ) {
    }

    public static function fromJson(string $data): self
    {
        $deserialized = json_decode($data, false, 512, JSON_THROW_ON_ERROR);
        $text = $deserialized[0]->text[0];

        return new self(
            $text->en,
            $text->fr,
            $text->nl,
        );
    }
}
