<?php

namespace App\Repository;

use App\Client\ApiManagerInterface;
use App\Entity\GenreList;
use Psr\Log\LoggerInterface;

class GenreRepository
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

    public function getAll(): GenreList
    {
        try {
            return $this->apiManager->call('GET', 'genre/movie/list', [], GenreList::class);
        } catch (\Exception $e) {
            $this->logger->error('error: ' . $e->getMessage());
        }
    }
}
