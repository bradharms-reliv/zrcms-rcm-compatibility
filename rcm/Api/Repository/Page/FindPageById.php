<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Page;

use Zrcms\CorePageDoctrine\Api\CmsResource\FindPageCmsResource;
use ZrcmsRcmCompatibility\RcmAdapter\RcmPageFromZrcmsPageCmsResource;

/**
 * @deprecated BC ONLY
 */
class FindPageById extends \Rcm\Api\Repository\Page\FindPageById
{
    protected $findPageCmsResource;
    protected $rcmPageFromZrcmsPageCmsResource;

    /**
     * @param FindPageCmsResource $findPageCmsResource
     */
    public function __construct(
        FindPageCmsResource $findPageCmsResource,
        RcmPageFromZrcmsPageCmsResource $rcmPageFromZrcmsPageCmsResource
    ) {
        $this->findPageCmsResource = $findPageCmsResource;
        $this->rcmPageFromZrcmsPageCmsResource = $rcmPageFromZrcmsPageCmsResource;
    }

    /**
     * @param       $id
     * @param array $options
     *
     * @return null|\ZrcmsRcmCompatibility\Rcm\Entity\Page
     * @throws \Zrcms\Core\Exception\TrackingInvalid
     */
    public function __invoke(
        $id,
        array $options = []
    ) {
        $pageCmsResource = $this->findPageCmsResource->__invoke(
            $id,
            $options
        );

        if (empty($pageCmsResource)) {
            return null;
        }

        return $this->rcmPageFromZrcmsPageCmsResource->__invoke(
            $pageCmsResource
        );
    }
}
