<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Page;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;

/**
 * @todo CONVERT THIS TO ZRCMS ADAPTER
 * @deprecated BC ONLY
 */
class PageExistsFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return PageExists
     */
    public function __invoke($serviceContainer)
    {
        return new PageExists(
            $serviceContainer->get(EntityManager::class)
        );
    }
}
