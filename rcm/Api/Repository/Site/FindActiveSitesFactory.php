<?php

namespace ZrcmsRcmCompatibility\Api\Repository\Site;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;

/**
 * @todo CONVERT THIS TO ZRCMS ADAPTER
 * @deprecated BC ONLY
 */
class FindActiveSitesFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return FindActiveSites
     */
    public function __invoke($serviceContainer)
    {
        return new FindActiveSites(
            $serviceContainer->get(EntityManager::class)
        );
    }
}