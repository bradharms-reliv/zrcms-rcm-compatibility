<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Page;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;

/**
 * @todo CONVERT THIS TO ZRCMS ADAPTER
 * @deprecated BC ONLY
 */
class FindPageByIdFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return FindPageById
     */
    public function __invoke($serviceContainer)
    {
        return new FindPageById(
            $serviceContainer->get(EntityManager::class)
        );
    }
}
