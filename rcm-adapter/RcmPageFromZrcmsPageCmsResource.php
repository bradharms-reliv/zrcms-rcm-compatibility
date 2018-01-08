<?php

namespace ZrcmsRcmCompatibility\RcmAdapter;

use Zrcms\CorePage\Model\PageCmsResource;
use Zrcms\CoreSite\Api\CmsResource\FindSiteCmsResource;
use ZrcmsRcmCompatibility\Rcm\Entity\Page;

/**
 * @deprecated BC ONLY
 * @author     James Jervis - https://github.com/jerv13
 */
class RcmPageFromZrcmsPageCmsResource
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
     * @param PageCmsResource $pageCmsResource
     * @param array           $options
     *
     * @return Page
     * @throws \Zrcms\Core\Exception\TrackingInvalid
     */
    public function __invoke(
        PageCmsResource $pageCmsResource,
        array $options = []
    ) {
        $siteCmsResource = $this->findSiteCmsResource->__invoke(
            $pageCmsResource->getSiteCmsResourceId()
        );
        $site = $this->rcmSiteFromZrcmsSiteCmsResource->__invoke(
            $siteCmsResource
        );

        return new Page(
            $pageCmsResource,
            $site
        );
    }
}
