<?php

namespace ZrcmsRcmCompatibility\Api\Repository\Site;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;

/**
 * @deprecated BC ONLY
 */
class FindAllSitesFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return FindAllSites
     */
    public function __invoke($serviceContainer)
    {
        return new FindAllSites(
            $serviceContainer->get(EntityManager::class)
        );
    }
}
