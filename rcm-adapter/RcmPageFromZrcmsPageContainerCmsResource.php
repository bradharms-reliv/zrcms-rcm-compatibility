<?php

namespace ZrcmsRcmCompatibility\RcmAdapter;

use Zrcms\ContentCore\Page\Model\PageContainerCmsResource;
use Zrcms\ContentCore\Site\Api\Repository\FindSiteCmsResource;
use ZrcmsRcmCompatibility\Rcm\Entity\Page;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class RcmPageFromZrcmsPageContainerCmsResource
{
    public function __construct(
        FindSiteCmsResource $findSiteCmsResource,
        RcmSiteFromZrcmsSiteCmsResource $rcmSiteFromZrcmsSiteCmsResource
    ) {
        $this->findSiteCmsResource = $findSiteCmsResource;
        $this->rcmSiteFromZrcmsSiteCmsResource = $rcmSiteFromZrcmsSiteCmsResource;
    }

    /**
     * @param PageContainerCmsResource $pageContainerCmsResource
     * @param array                    $options
     *
     * @return Page
     */
    public function __invoke(
        PageContainerCmsResource $pageContainerCmsResource,
        array $options = []
    ) {
        $siteCmsResource = $this->findSiteCmsResource->__invoke(
            $pageContainerCmsResource->getSiteCmsResourceId()
        );
        $site = $this->rcmSiteFromZrcmsSiteCmsResource->__invoke(
            $siteCmsResource
        );

        return new Page(
            $pageContainerCmsResource,
            $site
        );
    }
}
