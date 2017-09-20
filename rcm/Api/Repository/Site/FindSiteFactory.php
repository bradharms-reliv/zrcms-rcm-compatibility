<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Site;

use Interop\Container\ContainerInterface;
use Zrcms\ContentCore\Site\Api\Repository\FindSiteCmsResource;
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
    public function __invoke($serviceContainer)
    {
        return new FindSite(
            $serviceContainer->get(FindSiteCmsResource::class),
            $serviceContainer->get(RcmSiteFromZrcmsSiteCmsResource::class)
        );
    }
}
