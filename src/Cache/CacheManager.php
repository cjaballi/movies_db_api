<?php

namespace App\Cache;

use Psr\Cache\CacheItemInterface;
use Psr\Cache\CacheItemPoolInterface;

final class CacheManager implements CacheManagerInterface
{
    /** @var CacheItemPoolInterface */
    private $cacheItemPool;

    /** @var CacheItemInterface */
    private $cacheItem;

    public function __construct(CacheItemPoolInterface $cacheItemPool)
    {
        $this->cacheItemPool = $cacheItemPool;
    }

    public function retrieve(?CacheConfig $cacheConfig)
    {
        if (null === $cacheConfig) {
            return null;
        }

        $this->cacheItem = $this->cacheItemPool->getItem($cacheConfig->key);

        return $this->cacheItem->isHit() ? $this->cacheItem->get() : null;
    }

    public function persist(?CacheConfig $cacheConfig, $data): void
    {
        if (!$cacheConfig) {
            return;
        }

        $this->cacheItem->set($data);
        $this->cacheItem->expiresAfter($cacheConfig->duration);

        $this->cacheItemPool->save($this->cacheItem);
    }
}
