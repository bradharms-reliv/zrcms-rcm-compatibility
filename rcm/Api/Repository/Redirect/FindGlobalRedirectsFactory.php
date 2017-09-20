<?php

namespace ZrcmsRcmCompatibility\Api\Repository\Redirect;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;

/**
 * @deprecated BC ONLY
 */
class FindGlobalRedirectsFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return FindGlobalRedirects
     */
    public function __invoke($serviceContainer)
    {
        return new FindGlobalRedirects(
            $serviceContainer->get(EntityManager::class)
        );
    }
}
