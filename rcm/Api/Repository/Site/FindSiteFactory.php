<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Site;

use Interop\Container\ContainerInterface;
use Zrcms\CoreSite\Api\CmsResource\FindSiteCmsResource;
use ZrcmsRcmCompatibility\RcmAdapter\RcmSiteFromZrcmsSiteCmsResource;

/**
 * @deprecated BC ONLY
 */
class FindSiteFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return FindSite
     */
    public function __invoke(ContainerInterface $serviceContainer)
    {
        return new FindSite(
            $serviceContainer->get(FindSiteCmsResource::class),
            $serviceContainer->get(RcmSiteFromZrcmsSiteCmsResource::class)
        );
    }
}
