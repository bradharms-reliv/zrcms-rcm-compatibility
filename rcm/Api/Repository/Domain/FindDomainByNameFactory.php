<?php

namespace ZrcmsRcmCompatibility\Api\Repository\Domain;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;

/**
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
