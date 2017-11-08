<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Site;

use Interop\Container\ContainerInterface;
use Zrcms\ContentCore\Site\Api\Repository\FindSiteCmsResourcesBy;
use ZrcmsRcmCompatibility\RcmAdapter\FieldMapSite;
use ZrcmsRcmCompatibility\RcmAdapter\RcmSiteFromZrcmsSiteCmsResource;

/**
 * @deprecated BC ONLY
 */
class FindOneSiteFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return FindOneSite
     */
    public function __invoke($serviceContainer)
    {
        return new FindOneSite(
            $serviceContainer->get(FindSiteCmsResourcesBy::class),
            $serviceContainer->get(FieldMapSite::class),
            $serviceContainer->get(RcmSiteFromZrcmsSiteCmsResource::class)
        );
    }
}
