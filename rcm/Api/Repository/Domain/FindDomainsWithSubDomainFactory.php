<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Domain;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use ZrcmsRcmCompatibility\RcmAdapter\RcmSiteFromZrcmsSiteCmsResource;

/**
 * @deprecated BC ONLY
 */
class FindDomainsWithSubDomainFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return FindDomainsWithSubDomain
     */
    public function __invoke($serviceContainer)
    {
        return new FindDomainsWithSubDomain(
            $serviceContainer->get(EntityManager::class),
            $serviceContainer->get(RcmSiteFromZrcmsSiteCmsResource::class)
        );
    }
}
