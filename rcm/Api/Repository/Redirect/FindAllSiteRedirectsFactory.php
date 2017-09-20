<?php

namespace ZrcmsRcmCompatibility\Api\Repository\Redirect;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;

/**
 * @deprecated BC ONLY
 */
class FindAllSiteRedirectsFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return FindAllSiteRedirects
     */
    public function __invoke($serviceContainer)
    {
        return new FindAllSiteRedirects(
            $serviceContainer->get(EntityManager::class)
        );
    }
}
