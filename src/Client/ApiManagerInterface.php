<?php
namespace App\Client;

use App\Cache\CacheConfig;

interface ApiManagerInterface
{
    /**
     * @param string $method
     * @param string $uri
     * @param array $options
     * @param string|null $type
     * @param CacheConfig $cacheConfig
     *
     * @return array|object
     */
    public function call(string $method, string $uri, array $options = [], string $type = null, ?CacheConfig $cacheConfig = null);
}
