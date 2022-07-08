<?php

namespace App\Cache;

interface CacheManagerInterface
{
    public function retrieve(?CacheConfig $cacheConfig);

    public function persist(?CacheConfig $cacheConfig, $data): void;
}
