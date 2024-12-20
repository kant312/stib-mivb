<?php

declare(strict_types=1);

namespace Kant312\StibMivb;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;
use Kant312\StibMivb\Exceptions\RequestLimitExceeded;
use Kant312\StibMivb\Model\TravellersInformation;
use Kant312\StibMivb\Model\VehiclePositions;
use Kant312\StibMivb\Model\WaitingTime;
use stdClass;

final class Client
{
    private const API_ENDPOINT = 'https://stibmivb.opendatasoft.com/api/explore/v2.1/';

    private const PATH_TRAVELLERS_INFORMATION = 'catalog/datasets/travellers-information-rt-production/records';
    private const PATH_VEHICLE_POSITION = 'catalog/datasets/vehicle-position-rt-production/records';
    private const PATH_WAITING_TIMES = 'catalog/datasets/waiting-time-rt-production/records';

    private const PARAMS_API_KEY = 'apikey';

    private const HTTP_STATUS_TOO_MANY_REQUESTS = 429;

    private GuzzleClient $httpClient;
    private string $apiKey;

    private function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
        $this->httpClient = new GuzzleClient(
            ['base_uri' => self::API_ENDPOINT]
        );
    }

    public static function create(string $apiKey = ''): self
    {
        return new self($apiKey);
    }

    private function request(string $path): stdClass
    {
        try {
            $params = [];
            if ($this->apiKey !== '') {
                $params = [
                    'query' => [
                        self::PARAMS_API_KEY => $this->apiKey,
                    ],
                ];
            }

            $response = $this->httpClient->get($path, $params);
            $content = $response->getBody()->getContents();
        } catch (ClientException $e) {
            if ($e->getCode() === self::HTTP_STATUS_TOO_MANY_REQUESTS) {
                throw RequestLimitExceeded::create();
            }

            throw $e;
        }

        return json_decode($content, false, 10, JSON_THROW_ON_ERROR);
    }

    /**
     * @return TravellersInformation[]
     */
    public function latestTravellersInformation(): array
    {
        return array_map(
            fn ($travellersInformation) => TravellersInformation::fromObject($travellersInformation),
            $this->request(self::PATH_TRAVELLERS_INFORMATION)->results
        );
    }

    /**
     * @return WaitingTime[]
     */
    public function latestWaitingTimes(): array
    {
        return array_map(
            fn ($waitingTimes) => WaitingTime::fromObject($waitingTimes),
            $this->request(self::PATH_WAITING_TIMES)->results
        );
    }

    public function latestVehiclePositions()
    {
        return array_map(
            fn ($vehiclePositions) => VehiclePositions::fromObject($vehiclePositions),
            $this->request((self::PATH_VEHICLE_POSITION))->results
        );
    }
}
