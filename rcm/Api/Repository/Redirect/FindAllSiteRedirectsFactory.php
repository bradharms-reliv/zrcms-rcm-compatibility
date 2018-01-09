<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Redirect;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;

/**
 * @todo CONVERT THIS TO ZRCMS ADAPTER
 * @deprecated BC ONLY
 */
class FindAllSiteRedirectsFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return FindAllSiteRedirects
     */
    public function __invoke(ContainerInterface $serviceContainer)
    {
        return new FindAllSiteRedirects(
            $serviceContainer->get(EntityManager::class)
        );
    }
}
