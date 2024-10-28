<?php

declare(strict_types=1);

namespace Kant\StibMivb\Tests\Features;

use Kant\StibMivb\Client;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class TravellersInformationTest extends TestCase
{
    #[Test]
    public function travellers_information_can_be_fetched(): void
    {
        $travellersInformation = Client::create()->latestTravellersInformation();
        self::assertLessThan(20, count($travellersInformation));
    }
}