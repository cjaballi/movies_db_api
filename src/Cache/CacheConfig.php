<?php

namespace App\Cache;

final class CacheConfig
{
    public $key;

    public $duration;

    public function __construct(string $key, int $duration)
    {
        $this->key = $key;
        $this->duration = $duration;
    }
}
