<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Page;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;

/**
 * @todo CONVERT THIS TO ZRCMS ADAPTER
 * @deprecated BC ONLY
 */
class FindPageFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return FindPage
     */
    public function __invoke($serviceContainer)
    {
        return new FindPage(
            $serviceContainer->get(EntityManager::class)
        );
    }
}
