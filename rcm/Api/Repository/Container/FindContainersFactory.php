<?php

namespace ZrcmsRcmCompatibility\Api\Repository\Container;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;

/**
 * @deprecated BC ONLY
 */
class FindContainersFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return FindContainers
     */
    public function __invoke($serviceContainer)
    {
        return new FindContainers(
            $serviceContainer->get(EntityManager::class)
        );
    }
}
