<?php

namespace App\Client;

use App\Cache\CacheConfig;
use App\Cache\CacheManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\Serializer\SerializerInterface;


class ApiManager implements ApiManagerInterface
{
    /** @var HttpClientInterface */
    private $client;

    /** @var LoggerInterface */
    private $logger;

    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * @var CacheManagerInterface
     */
    private $cacheManager;

    /**
     * @var string
     */
    private $apiKey;

    public function __construct(
        HttpClientInterface   $httpClientApi,
        SerializerInterface   $serializer,
        CacheManagerInterface $cacheManager,
        LoggerInterface       $logger,
        string                $apiKey
    )
    {
        $this->client = $httpClientApi;
        $this->serializer = $serializer;
        $this->cacheManager = $cacheManager;
        $this->logger = $logger;
        $this->apiKey = $apiKey;
    }

    /**
     * @inheritDoc
     */
    public function call(string $method, string $uri, array $options = [], string $type = null, ?CacheConfig $cacheConfig = null)
    {
        $responseContent = $responseFromCache = null;

        if (null !== $cacheConfig) {
            $responseFromCache = $this->cacheManager->retrieve($cacheConfig);

            if ($responseFromCache) {
                $responseContent = $responseFromCache;
            }
        }

        if (null === $responseFromCache) {
            $options['query'] = array_merge(
                $options['query'] ?? [],
                ['api_key' => $this->apiKey]
            );

            $response = $this->client->request($method, $uri, $options);

            if (!\in_array($response->getStatusCode(), [200, 201])) {
                throw new \Exception('Response code KO" !');
            }

            $responseContent = $response->getContent();

            if (null !== $cacheConfig) {
                $this->cacheManager->persist($cacheConfig, $responseContent, 'json');
            }
        }

        if (null !== $type) {
            return $this->serializer->deserialize($responseContent, $type, 'json');
        }

        return $response->toArray();
    }
}
