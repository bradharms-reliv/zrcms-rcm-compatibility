<?php

namespace ZrcmsRcmCompatibility\Api\Repository\Site;

use Rcm\Entity\Site;
use Zrcms\ContentCore\Site\Api\Repository\FindSiteCmsResource;
use ZrcmsRcmCompatibility\RcmAdapter\RcmSiteFromZrcmsSiteCmsResource;

/**
 * @deprecated BC ONLY
 */
class FindSite
{
    /**
     * @param FindSiteCmsResource             $findSiteCmsResource
     * @param RcmSiteFromZrcmsSiteCmsResource $rcmSiteFromZrcmsSiteCmsResource
     */
    public function __construct(
        FindSiteCmsResource $findSiteCmsResource,
        RcmSiteFromZrcmsSiteCmsResource $rcmSiteFromZrcmsSiteCmsResource
    ) {
        $this->findSiteCmsResource = $findSiteCmsResource;
        $this->rcmSiteFromZrcmsSiteCmsResource = $rcmSiteFromZrcmsSiteCmsResource;
    }

    /**
     * @param int   $id
     * @param array $options
     *
     * @return null|Site
     */
    public function __invoke(
        int $id,
        array $options = []
    ) {
        $siteCmsResource = $this->findSiteCmsResource->__invoke(
            $id
        );

        return $this->rcmSiteFromZrcmsSiteCmsResource->__invoke($siteCmsResource);
    }
}
