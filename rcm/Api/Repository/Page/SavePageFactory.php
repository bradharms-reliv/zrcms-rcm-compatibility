<?php

namespace ZrcmsRcmCompatibility\Api\Repository\Page;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;

/**
 * @deprecated BC ONLY
 */
class SavePageFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return SavePage
     */
    public function __invoke($serviceContainer)
    {
        return new SavePage(
            $serviceContainer->get(EntityManager::class)
        );
    }
}
