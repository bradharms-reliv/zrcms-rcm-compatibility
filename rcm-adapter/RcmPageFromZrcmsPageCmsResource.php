<?php

namespace ZrcmsRcmCompatibility\RcmAdapter;

use Zrcms\ContentCore\Page\Model\PageCmsResource;
use Zrcms\ContentCore\Site\Api\CmsResource\FindSiteCmsResource;
use ZrcmsRcmCompatibility\Rcm\Entity\Page;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class RcmPageFromZrcmsPageCmsResource
{
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
