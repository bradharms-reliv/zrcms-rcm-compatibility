<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Redirect;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;

/**
 * @todo CONVERT THIS TO ZRCMS ADAPTER
 * @deprecated BC ONLY
 */
class FindRedirectFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return FindRedirect
     */
    public function __invoke($serviceContainer)
    {
        return new FindRedirect(
            $serviceContainer->get(EntityManager::class)
        );
    }
}
