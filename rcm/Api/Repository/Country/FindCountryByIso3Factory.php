<?php

namespace ZrcmsRcmCompatibility\Api\Repository\Country;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;

/**
 * @deprecated BC ONLY
 */
class FindCountryByIso3Factory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return FindCountryByIso3
     */
    public function __invoke($serviceContainer)
    {
        return new FindCountryByIso3(
            $serviceContainer->get(EntityManager::class)
        );
    }
}
