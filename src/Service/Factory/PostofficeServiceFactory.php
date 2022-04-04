<?php

namespace AthenaPostoffice\Service\Factory;

use AthenaPostoffice\Service\PostofficeService;
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class PostofficeServiceFactory implements FactoryInterface
{

    /**
     * @inheritDoc
     */
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = null)
    {
        return new PostofficeService($container);
    }
}