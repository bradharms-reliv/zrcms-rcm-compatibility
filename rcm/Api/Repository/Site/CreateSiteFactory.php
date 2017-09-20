<?php

namespace ZrcmsRcmCompatibility\Api\Repository\Site;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;

/**
 * @deprecated BC ONLY
 */
class CreateSiteFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return CreateSite
     */
    public function __invoke($serviceContainer)
    {
        return new CreateSite(
            $serviceContainer->get(EntityManager::class)
        );
    }
}
