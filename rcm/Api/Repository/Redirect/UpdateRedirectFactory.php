<?php

namespace ZrcmsRcmCompatibility\Api\Repository\Redirect;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;

/**
 * @todo CONVERT THIS TO ZRCMS ADAPTER
 * @deprecated BC ONLY
 */
class UpdateRedirectFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return UpdateRedirect
     */
    public function __invoke($serviceContainer)
    {
        return new UpdateRedirect(
            $serviceContainer->get(EntityManager::class)
        );
    }
}
