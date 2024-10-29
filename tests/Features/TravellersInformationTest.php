<?php

declare(strict_types=1);

namespace Kant312\StibMivb\Tests\Features;

use Kant312\StibMivb\Client;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class TravellersInformationTest extends TestCase
{
    #[Test]
    public function travellers_information_can_be_fetched(): void
    {
        $apiKey = getenv('STIB_MIVB_API_KEY');
        $apiKey = ($apiKey === false) ? '' : $apiKey;
        $travellersInformation = Client::create($apiKey)->latestTravellersInformation();
        self::assertLessThan(20, count($travellersInformation));
    }
}