<?php

declare(strict_types=1);

namespace Kant312\StibMivb\Tests\Features;

use Kant312\StibMivb\Client;
use Kant312\StibMivb\Model\WaitingTime;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class WaitingTimesTest extends TestCase
{
    #[Test]
    public function waiting_times_can_be_fetched(): void
    {
        $waitingTimes = Client::create()->latestWaitingTimes();
        self::assertContainsOnlyInstancesOf(WaitingTime::class, $waitingTimes);
    }
}