<?php

namespace ZrcmsRcmCompatibility\Api\Repository\Country;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;

/**
 * @todo CONVERT THIS TO ZRCMS ADAPTER
 * @deprecated BC ONLY
 */
class FindCountryByIso2Factory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return FindCountryByIso2
     */
    public function __invoke($serviceContainer)
    {
        return new FindCountryByIso2(
            $serviceContainer->get(EntityManager::class)
        );
    }
}
