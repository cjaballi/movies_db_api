<?php

namespace App\Tests\Repository;

use App\Client\ApiManagerInterface;
use App\Entity\Configuration;
use App\Repository\ConfigurationRepository;
use PHPUnit\Framework\TestCase;
use Psr\Log\LoggerInterface;

class ConfigurationRepositoryTest extends TestCase
{
    public function testGet()
    {
        $apiManagerMock = $this->createMock(ApiManagerInterface::class);
        $loggerock = $this->createMock(LoggerInterface::class);
        $configurationRepository = new ConfigurationRepository($apiManagerMock, $loggerock);
        $configuration = new Configuration();
        $apiManagerMock->method('call')->willReturn($configuration);
        $apiManagerMock->expects(self::once())->method('call');
        $this->assertEquals($configuration, $configurationRepository->get());
    }
}