<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Container;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;

/**
 * @todo CONVERT THIS TO ZRCMS ADAPTER
 * @deprecated BC ONLY
 */
class FindContainersFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return FindContainers
     */
    public function __invoke(ContainerInterface $serviceContainer)
    {
        return new FindContainers(
            $serviceContainer->get(EntityManager::class)
        );
    }
}
