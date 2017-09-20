<?php

namespace ZrcmsRcmCompatibility\Api\Repository\Page;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;

/**
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
