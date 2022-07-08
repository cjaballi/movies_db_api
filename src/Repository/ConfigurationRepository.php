<?php

namespace App\Repository;

use App\Cache\CacheConfig;
use App\Client\ApiManagerInterface;
use App\Entity\Configuration;
use Psr\Log\LoggerInterface;

class ConfigurationRepository
{
    /**
     * @var ApiManagerInterface
     */
    private $apiManager;
    /**
     * @var LoggerInterface
     */
    private $logger;

    public function __construct(ApiManagerInterface $apiManager, LoggerInterface $logger)
    {
        $this->apiManager = $apiManager;
        $this->logger = $logger;
    }

    public function get(): Configuration
    {
        try {
            $cacheConfig = new CacheConfig('configuration', 86400); // 24 hours

            return $this->apiManager->call('GET', 'configuration', [], Configuration::class, $cacheConfig);
        } catch (\Exception $e) {
            $this->logger->error('error: ' . $e->getMessage());
        }
    }
}
