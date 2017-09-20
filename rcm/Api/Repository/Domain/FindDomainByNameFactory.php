<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Domain;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;

/**
 * @todo CONVERT THIS TO ZRCMS ADAPTER
 * @deprecated BC ONLY
 */
class FindDomainByNameFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return FindDomainByName
     */
    public function __invoke($serviceContainer)
    {
        return new FindDomainByName(
            $serviceContainer->get(EntityManager::class)
        );
    }
}
