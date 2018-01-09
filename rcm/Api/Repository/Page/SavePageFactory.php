<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Page;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;

/**
 * @todo CONVERT THIS TO ZRCMS ADAPTER
 * @deprecated BC ONLY
 */
class SavePageFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return SavePage
     */
    public function __invoke(ContainerInterface $serviceContainer)
    {
        return new SavePage(
            $serviceContainer->get(EntityManager::class)
        );
    }
}
