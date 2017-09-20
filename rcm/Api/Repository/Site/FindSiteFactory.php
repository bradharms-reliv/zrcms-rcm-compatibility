<?php

namespace ZrcmsRcmCompatibility\Api\Repository\Site;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;

/**
 * @deprecated BC ONLY
 */
class FindSiteFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return FindSite
     */
    public function __invoke($serviceContainer)
    {
        return new FindSite(
            $serviceContainer->get(EntityManager::class)
        );
    }
}
