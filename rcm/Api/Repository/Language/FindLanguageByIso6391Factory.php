<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Language;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;

/**
 * @todo CONVERT THIS TO ZRCMS ADAPTER
 * @deprecated BC ONLY
 */
class FindLanguageByIso6391Factory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return FindLanguageByIso6391
     */
    public function __invoke(ContainerInterface $serviceContainer)
    {
        return new FindLanguageByIso6391(
            $serviceContainer->get(EntityManager::class)
        );
    }
}
