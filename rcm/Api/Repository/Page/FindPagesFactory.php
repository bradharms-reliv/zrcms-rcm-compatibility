<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Page;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;

/**
 * @todo CONVERT THIS TO ZRCMS ADAPTER
 * @deprecated BC ONLY
 */
class FindPagesFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return FindPages
     */
    public function __invoke(ContainerInterface $serviceContainer)
    {
        return new FindPages(
            $serviceContainer->get(EntityManager::class)
        );
    }
}
