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
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $serviceContainer)
    {
        return new FindSiteRedirects(
            $serviceContainer->get(EntityManager::class)
        );
    }
}
