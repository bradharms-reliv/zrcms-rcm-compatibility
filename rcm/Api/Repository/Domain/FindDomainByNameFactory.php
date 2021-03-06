<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Domain;

use Interop\Container\ContainerInterface;
use Zrcms\CoreSite\Api\CmsResource\FindSiteCmsResourceByHost;
use ZrcmsRcmCompatibility\RcmAdapter\RcmSiteFromZrcmsSiteCmsResource;

/**
 * @deprecated BC ONLY
 */
class FindDomainByNameFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return FindDomainByName
     */
    public function __invoke(ContainerInterface $serviceContainer)
    {
        return new FindDomainByName(
            $serviceContainer->get(FindSiteCmsResourceByHost::class),
            $serviceContainer->get(RcmSiteFromZrcmsSiteCmsResource::class)
        );
    }
}
