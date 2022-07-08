<?php

namespace App\Tests\Repository;

use App\Client\ApiManagerInterface;
use App\Entity\GenreList;
use App\Repository\GenreRepository;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class GenreRepositoryTest extends TestCase
{
    public function testGetAll()
    {
        $apiManagerMock = $this->createMock(ApiManagerInterface::class);
        $loggerock = $this->createMock(LoggerInterface::class);
        $genreRepository = new GenreRepository($apiManagerMock, $loggerock);
        $genreList = new GenreList();
        $apiManagerMock->method('call')->willReturn($genreList);
        $apiManagerMock->expects(self::once())->method('call');
        $this->assertEquals($genreList, $genreRepository->getAll());
    }
}