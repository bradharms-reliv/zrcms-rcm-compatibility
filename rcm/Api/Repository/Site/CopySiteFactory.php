<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Site;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;

/**
 * @todo CONVERT THIS TO ZRCMS ADAPTER
 * @deprecated BC ONLY
 */
class CopySiteFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return CopySite
     */
    public function __invoke($serviceContainer)
    {
        return new CopySite(
            $serviceContainer->get(EntityManager::class)
        );
    }
}
