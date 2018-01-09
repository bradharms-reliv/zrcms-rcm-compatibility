<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Redirect;

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
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $serviceContainer)
    {
        return new UpdateRedirect(
            $serviceContainer->get(EntityManager::class)
        );
    }
}
