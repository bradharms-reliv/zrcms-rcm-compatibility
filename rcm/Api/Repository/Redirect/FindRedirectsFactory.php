<?php

namespace ZrcmsRcmCompatibility\Api\Repository\Redirect;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;

/**
 * @todo CONVERT THIS TO ZRCMS ADAPTER
 * @deprecated BC ONLY
 */
class FindRedirectsFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return FindRedirects
     */
    public function __invoke($serviceContainer)
    {
        return new FindRedirects(
            $serviceContainer->get(EntityManager::class)
        );
    }
}
