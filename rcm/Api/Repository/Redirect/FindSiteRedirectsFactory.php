<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Redirect;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;

/**
 * @todo CONVERT THIS TO ZRCMS ADAPTER
 * @deprecated BC ONLY
 */
class FindSiteRedirectsFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return FindSiteRedirects
     */
    public function __invoke($serviceContainer)
    {
        return new FindSiteRedirects(
            $serviceContainer->get(EntityManager::class)
        );
    }
}
