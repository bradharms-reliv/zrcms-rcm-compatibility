<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Page;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;

/**
 * @todo CONVERT THIS TO ZRCMS ADAPTER
 * @deprecated BC ONLY
 */
class FindPagesByTypeFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return FindPagesByType
     */
    public function __invoke(ContainerInterface $serviceContainer)
    {
        return new FindPagesByType(
            $serviceContainer->get(EntityManager::class)
        );
    }
}
