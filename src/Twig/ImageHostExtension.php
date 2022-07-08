<?php

namespace App\Twig;

use App\Repository\ConfigurationRepository;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class ImageHostExtension extends AbstractExtension
{
    /**
     * @var ConfigurationRepository
     */
    private $configurationRepository;

    public function __construct(ConfigurationRepository $configurationRepository)
    {
        $this->configurationRepository = $configurationRepository;

    }
    public function getFunctions(): array
    {
        return [
            new TwigFunction('image_host', [$this, 'getImageHost']),
        ];
    }

    public function getImageHost(string $size)
    {
        $configuration = $this->configurationRepository->get();

        return $configuration->getImages()['secure_base_url'].$size;

    }
}
