<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Redirect;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;

/**
 * @todo CONVERT THIS TO ZRCMS ADAPTER
 * @deprecated BC ONLY
 */
class RemoveRedirectFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return RemoveRedirect
     */
    public function __invoke($serviceContainer)
    {
        return new RemoveRedirect(
            $serviceContainer->get(EntityManager::class)
        );
    }
}
