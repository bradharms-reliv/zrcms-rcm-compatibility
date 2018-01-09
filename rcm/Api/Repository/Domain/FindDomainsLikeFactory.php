<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Domain;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;

/**
 * @todo CONVERT THIS TO ZRCMS ADAPTER
 * @deprecated BC ONLY
 */
class FindDomainsLikeFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return FindDomainsLike
     */
    public function __invoke(ContainerInterface $serviceContainer)
    {
        return new FindDomainsLike(
            $serviceContainer->get(EntityManager::class)
        );
    }
}
