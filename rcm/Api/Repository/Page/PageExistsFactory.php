<?php

namespace ZrcmsRcmCompatibility\Api\Repository\Page;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;

/**
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
