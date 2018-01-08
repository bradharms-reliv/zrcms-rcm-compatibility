<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Site;

use Rcm\Entity\Site;
use Zrcms\CoreSite\Api\CmsResource\FindSiteCmsResource;
use ZrcmsRcmCompatibility\RcmAdapter\RcmSiteFromZrcmsSiteCmsResource;

/**
 * @deprecated BC ONLY
 */
class FindSite extends \Rcm\Api\Repository\Site\FindSite
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
     * @return null|Site|\ZrcmsRcmCompatibility\Rcm\Entity\Site
     * @throws \Zrcms\Core\Exception\TrackingInvalid
     */
    public function __invoke(
        int $id,
        array $options = []
    ) {
        $siteCmsResource = $this->findSiteCmsResource->__invoke(
            $id
        );

        if (empty($siteCmsResource)) {
            return null;
        }

        return $this->rcmSiteFromZrcmsSiteCmsResource->__invoke($siteCmsResource);
    }
}
