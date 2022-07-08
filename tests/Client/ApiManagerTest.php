<?php

namespace App\Tests\Client;

use App\Cache\CacheManagerInterface;
use App\Client\ApiManager;
use App\Entity\Movie;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpClient\Response\TraceableResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class ApiManagerTest extends TestCase
{
    public function testCall()
    {
        $clientMock = $this->createMock(HttpClientInterface::class);
        $serializeMock = $this->createMock(SerializerInterface::class);
        $cacheMock = $this->createMock(CacheManagerInterface::class);
        $loggerMock = $this->createMock(LoggerInterface::class);
        $responseMock = $this->createMock(TraceableResponse::class);
        $responseMock->method('getStatusCode')->willReturn(200);
        $responseMock->method('getContent')->willReturn('{"test":"test"}');
        $clientMock->method('request')->willReturn($responseMock);
        $movie = new Movie();
        $serializeMock->method('deserialize')->willReturn($movie);
        $apiManager = new ApiManager($clientMock, $serializeMock, $cacheMock, $loggerMock, 'test');
        $this->assertEquals($movie, $apiManager->call('get', 'http://testurl', [], Movie::class));
    }
}