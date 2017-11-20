<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Site;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;

/**
 * @deprecated BC ONLY
 */
class SetThemeFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return SetTheme
     */
    public function __invoke($serviceContainer)
    {
        return new SetTheme(
            $serviceContainer->get(EntityManager::class)
        );
    }
}
