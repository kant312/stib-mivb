# Connect your PHP application to the STIB-MIVB APIs

This package is in early development. 
For now you can retrieve:

- The latest travellers information
- The latest waiting times

## Travellers information

```php
use Kant312\StibMivb\Client;

$travelersInformation = Client::create('your-api-key')->latestTravellersInformation();
```

The above will return an array of objects such as this one:

```
object(Kant312\StibMivb\Model\TravellersInformation)#428 (4) {
  ["priority"]=>
  object(Kant312\StibMivb\Model\Priority)#424 (1) {
    ["priority"]=>
    int(5)
  }
  ["description"]=>
  object(Kant312\StibMivb\Model\TravellersInformationDescription)#417 (3) {
    ["english"]=>
    string(105) "November 1st, All Saints. Bus 77 operates exceptionally on its whole itinerary from 8. 40AM until 4.45PM."
    ["french"]=>
    string(93) "1/11. Toussaint. Bus 77 circule exceptionnellement sur tout son itinéraire de 8h40 à 16h45."
    ["dutch"]=>
    string(104) "1/11. Allerheiligen. Bus 77 rijdt uitzonderlijk langs zijn volledige reisweg van 8.40 uur tot 16.45 uur."
  }
  ["lines"]=>
  array(1) {
    [0]=>
    object(Kant312\StibMivb\Model\LineID)#432 (1) {
      ["lineId"]=>
      string(1) "1"
    }
  }
  ["points"]=>
  array(2) {
    [0]=>
    object(Kant312\StibMivb\Model\PointID)#420 (1) {
      ["pointId"]=>
      int(8152)
    }
    [1]=>
    object(Kant312\StibMivb\Model\PointID)#419 (1) {
      ["pointId"]=>
      int(8151)
    }
  }
}
```

## Waiting times

```php
use Kant312\StibMivb\Client;

$waitingTimes = Client::create('your-api-key')->latestWaitingTimes();
```

The above will return an array of objects like that:

```
object(Kant312\StibMivb\Model\WaitingTime)#153 (3) {
  ["pointID"]=>
  object(Kant312\StibMivb\Model\PointID)#22 (1) {
    ["pointId"]=>
    int(1696)
  }
  ["lineID"]=>
  object(Kant312\StibMivb\Model\LineID)#26 (1) {
    ["lineId"]=>
    string(2) "62"
  }
  ["passingTimes"]=>
  object(Kant312\StibMivb\Model\PassingTimes)#160 (6) {
    ["destinationFr"]=>
    string(0) ""
    ["destinationNl"]=>
    string(0) ""
    ["messageEn"]=>
    string(14) "End of service"
    ["messageFr"]=>
    string(14) "Fin de service"
    ["messageNl"]=>
    string(12) "Einde dienst"
    ["expectedArrivalTime"]=>
    object(DateTimeImmutable)#161 (3) {
      ["date"]=>
      string(26) "2024-10-29 23:35:00.000000"
      ["timezone_type"]=>
      int(1)
      ["timezone"]=>
      string(6) "+01:00"
    }
  }
}
```