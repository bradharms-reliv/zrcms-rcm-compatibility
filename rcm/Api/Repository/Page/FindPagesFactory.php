<?php

namespace ZrcmsRcmCompatibility\Api\Repository\Page;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;

/**
 * @deprecated BC ONLY
 */
class FindPagesFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return FindPages
     */
    public function __invoke($serviceContainer)
    {
        return new FindPages(
            $serviceContainer->get(EntityManager::class)
        );
    }
}
