<?php

namespace Kant312\StibMivb\Tests\Features;

use Kant312\StibMivb\Client;
use Kant312\StibMivb\Model\VehiclePositions;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class VehiclePositionTest extends TestCase
{
    #[Test]
    public function testVehiclePosition()
    {
        $apiKey = getenv('STIB_MIVB_API_KEY');
        $apiKey = ($apiKey === false) ? '' : $apiKey;
        $vehiclePositions = Client::create($apiKey)->latestVehiclePositions();
        self::assertContainsOnlyInstancesOf(VehiclePositions::class, $vehiclePositions);
    }
}
