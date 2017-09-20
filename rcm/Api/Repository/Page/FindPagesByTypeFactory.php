<?php

namespace ZrcmsRcmCompatibility\Api\Repository\Page;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;

/**
 * @deprecated BC ONLY
 */
class FindPagesByTypeFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return FindPagesByType
     */
    public function __invoke($serviceContainer)
    {
        return new FindPagesByType(
            $serviceContainer->get(EntityManager::class)
        );
    }
}
