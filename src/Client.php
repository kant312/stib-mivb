<?php

declare(strict_types=1);

namespace Kant\StibMivb;

use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Psr7\Response;
use Kant\StibMivb\Exceptions\RequestLimitExceeded;
use Psr\Http\Message\ResponseInterface;
use stdClass;

final class Client
{
    private const API_ENDPOINT = 'https://stibmivb.opendatasoft.com/api/explore/v2.1/';
    
    private const PATH_TRAVELLERS_INFORMATION = 'catalog/datasets/travellers-information-rt-production/records';
    
    private const HTTP_STATUS_TOO_MANY_REQUESTS = 429;

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

    private function request(string $path): stdClass
    {
        try {
            $response = $this->httpClient->get($path);
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
     * @return int[]
     */
    public function latestWaitingTimes(): array
    {
        return [];
    }
}