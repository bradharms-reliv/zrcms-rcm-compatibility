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
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $serviceContainer)
    {
        return new CopySite(
            $serviceContainer->get(EntityManager::class)
        );
    }
}
