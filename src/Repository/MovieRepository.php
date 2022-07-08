<?php

namespace App\Repository;

use App\Client\ApiManagerInterface;
use App\Entity\Movie;
use App\Entity\MovieList;
use App\Entity\VideoList;
use Psr\Log\LoggerInterface;

class MovieRepository
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

    public function get(int $id): Movie
    {
        try {
            return $this->apiManager->call('GET', "movie/$id", [], Movie::class);
        } catch (\Exception $e) {
            $this->logError($e);
        }
    }

    public function getList($filters = []): MovieList
    {
        $options = [];

        if (!empty($filters)) {
            foreach ($filters as $filter => $filterValue) {
                $options['query'][$filter] = $filterValue;
            }
        }

        try {
            return $this->apiManager->call('GET', "discover/movie", $options, MovieList::class);
        } catch (\Exception $e) {
            $this->logError($e);
        }
    }

    public function getPopularMovies(): MovieList
    {
        try {
            return $this->apiManager->call('GET', 'movie/popular', [], MovieList::class);
        } catch (\Exception $e) {
            $this->logError($e);
        }
    }

    public function getVideos($movieId): VideoList
    {
        try {
            return $this->apiManager->call('GET', "movie/$movieId/videos", [], VideoList::class);
        } catch (\Exception $e) {
            $this->logError($e);
        }
    }

    public function searchMovies(string $term): MovieList
    {
        try {
            return $this->apiManager->call('GET', 'search/movie', ['query' => ['query' => $term]], MovieList::class);
        } catch (\Exception $e) {
            $this->logError($e);
        }
    }

    private function logError(\Exception $e)
    {
        $this->logger->error('error: ' . $e->getMessage());
    }

}
