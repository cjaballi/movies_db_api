<?php

namespace App\Tests\Repository;

use App\Client\ApiManagerInterface;
use App\Entity\Movie;
use App\Entity\MovieList;
use App\Entity\VideoList;
use App\Repository\MovieRepository;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

/**
 * class MovieRepositoryTestt
 */
class MovieRepositoryTestt extends TestCase
{

    private $apiManagerMock;
    private $loggerMock;

    protected function setUp()
    {
        parent::setUp();
        $this->apiManagerMock = $this->createMock(ApiManagerInterface::class);
        $this->loggerock = $this->createMock(LoggerInterface::class);

    }

    /**
     * Test execution of a query
     */
    public function testGet()
    {
        $movieRepository = new MovieRepository($this->apiManagerMock, $this->loggerock);
        $movie = new Movie();
        $this->apiManagerMock->method('call')->willReturn($movie);
        $this->apiManagerMock->expects(self::once())->method('call');
        $this->assertEquals($movie, $movieRepository->get(1));
    }

    public function testGetList()
    {
        $movieRepository = new MovieRepository($this->apiManagerMock, $this->loggerock);
        $movies = new MovieList();
        $this->apiManagerMock->method('call')->willReturn($movies);
        $this->apiManagerMock->expects(self::once())->method('call');
        $this->assertEquals($movies, $movieRepository->getList([]));
    }

    public function testGetPopularMovies()
    {
        $movieRepository = new MovieRepository($this->apiManagerMock, $this->loggerock);
        $movies = new MovieList();
        $this->apiManagerMock->method('call')->willReturn($movies);
        $this->apiManagerMock->expects(self::once())->method('call');
        $this->assertEquals($movies, $movieRepository->getPopularMovies());
    }

    public function testGetVideos()
    {
        $movieRepository = new MovieRepository($this->apiManagerMock, $this->loggerock);
        $videoList = new VideoList();
        $this->apiManagerMock->method('call')->willReturn($videoList);
        $this->apiManagerMock->expects(self::once())->method('call');
        $this->assertEquals($videoList, $movieRepository->getVideos(1));
    }

    public function testSearchMovies()
    {
        $movieRepository = new MovieRepository($this->apiManagerMock, $this->loggerock);
        $movies = new MovieList();
        $this->apiManagerMock->method('call')->willReturn($movies);
        $this->apiManagerMock->expects(self::once())->method('call');
        $this->assertEquals($movies, $movieRepository->searchMovies('test'));
    }

}