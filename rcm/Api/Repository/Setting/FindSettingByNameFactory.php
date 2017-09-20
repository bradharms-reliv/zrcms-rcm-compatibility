<?php

namespace ZrcmsRcmCompatibility\Api\Repository\Setting;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;

/**
 * @deprecated BC ONLY
 */
class FindSettingByNameFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return FindSettingByName
     */
    public function __invoke($serviceContainer)
    {
        return new FindSettingByName(
            $serviceContainer->get(EntityManager::class)
        );
    }
}
