<?php

namespace ZrcmsRcmCompatibility\Api\Repository\Redirect;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;

/**
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
