<?php

declare(strict_types=1);

namespace Kant\StibMivb;

use GuzzleHttp\Client as GuzzleClient;

final class Client
{
    private const API_ENDPOINT = 'https://stibmivb.opendatasoft.com/api/explore/v2.1/';
    private const PATH_TRAVELLERS_INFORMATION = 'catalog/datasets/travellers-information-rt-production/records';

    private GuzzleClient $httpClient;

    private function __construct()
    {
        $this->httpClient = new GuzzleClient(
            ['base_uri' => self::API_ENDPOINT]
        );
    }

    public static function create(): self
    {
        return new self();
    }

    /**
     * @return TravellersInformation[]
     */
    public function latestTravellersInformation(): array
    {
        $response = $this->httpClient->get(self::PATH_TRAVELLERS_INFORMATION);
        $content = $response->getBody()->getContents();
        $unserialized = json_decode($content, false, 10, JSON_THROW_ON_ERROR);
        
        return array_map(fn ($travellersInformation) => TravellersInformation::fromObject($travellersInformation) , $unserialized->results);
    }
}