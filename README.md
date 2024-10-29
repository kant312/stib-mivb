# Connect your PHP application to the STIB-MIVB APIs

This package is in early development. 
For now you can retrieve the latest travellers information using the following code:

```php
use Kant312\StibMivb\Client;

$travelersInformation = Client::create('your-api-key')->latestTravellersInformation();
```

=> Response is an array of POPOs hydrated from the STIB-MIVB APIs.