<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Redirect;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;

/**
 * @todo CONVERT THIS TO ZRCMS ADAPTER
 * @deprecated BC ONLY
 */
class CreateRedirectFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return CreateRedirect
     */
    public function __invoke($serviceContainer)
    {
        return new CreateRedirect(
            $serviceContainer->get(EntityManager::class)
        );
    }
}
