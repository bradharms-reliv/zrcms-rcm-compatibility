<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Redirect;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;

/**
 * @todo CONVERT THIS TO ZRCMS ADAPTER
 * @deprecated BC ONLY
 */
class FindGlobalRedirectsFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return FindGlobalRedirects
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $serviceContainer)
    {
        return new FindGlobalRedirects(
            $serviceContainer->get(EntityManager::class)
        );
    }
}
