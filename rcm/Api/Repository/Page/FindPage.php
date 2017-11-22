<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Page;

use Rcm\Entity\Page;
use Rcm\Page\PageTypes\PageTypes;
use Zrcms\ContentCore\Page\Api\CmsResource\FindPageCmsResourceBySitePath;
use Zrcms\ContentCore\Page\Api\CmsResource\FindPageCmsResourcesBy;
use Zrcms\ContentCore\Page\Api\CmsResource\FindPageTemplateCmsResourceBySitePath;
use Zrcms\ContentCore\Page\Api\CmsResource\FindPageTemplateCmsResourcesBy;
use ZrcmsRcmCompatibility\RcmAdapter\PreparePath;
use ZrcmsRcmCompatibility\RcmAdapter\RcmPageFromZrcmsPageCmsResource;

/**
 * @deprecated BC ONLY
 */
class FindPage extends \Rcm\Api\Repository\Page\FindPage
{
    /**
     * @var FindPageCmsResourcesBy
     */
    protected $findPageCmsResourcesBy;

    /**
     * @var FindPageTemplateCmsResourcesBy
     */
    protected $findPageTemplateCmsResourcesBy;

    /**
     * @var RcmPageFromZrcmsPageCmsResource
     */
    protected $rcmPageFromZrcmsPageCmsResource;

    /**
     * @param FindPageCmsResourcesBy                   $findPageCmsResourcesBy
     * @param FindPageTemplateCmsResourcesBy           $findPageTemplateCmsResourcesBy
     * @param RcmPageFromZrcmsPageCmsResource $rcmPageFromZrcmsPageCmsResource
     */
    public function __construct(
        FindPageCmsResourcesBy $findPageCmsResourcesBy,
        FindPageTemplateCmsResourcesBy $findPageTemplateCmsResourcesBy,
        RcmPageFromZrcmsPageCmsResource $rcmPageFromZrcmsPageCmsResource
    ) {
        $this->findPageCmsResourcesBy = $findPageCmsResourcesBy;
        $this->findPageTemplateCmsResourcesBy = $findPageTemplateCmsResourcesBy;
        $this->rcmPageFromZrcmsPageCmsResource = $rcmPageFromZrcmsPageCmsResource;
    }

    /**
     * @param int    $siteId
     * @param string $pageName
     * @param string $pageType
     * @param array  $options
     *
     * @return null|Page
     * @throws \Exception
     */
    public function __invoke(
        int $siteId,
        string $pageName,
        string $pageType = PageTypes::NORMAL,
        array $options = []
    ) {
        $pagePath = PreparePath::invoke($pageName, $pageType);

        if ($pageType == PageTypes::TEMPLATE) {
            $pageCmsResources = $this->findPageTemplateCmsResourcesBy->__invoke(
                ['siteCmsResourceId' => $siteId, 'path' => $pagePath],
                null,
                1
            );
        } else {
            $pageCmsResources = $this->findPageCmsResourcesBy->__invoke(
                ['siteCmsResourceId' => $siteId, 'path' => $pagePath],
                null,
                1
            );
        }

        if (empty($pageCmsResources)) {
            return null;
        }

        if (count($pageCmsResources) > 2) {
            throw new \Exception(
                "Duplicate pages found for siteId: {$siteId} page: {$pageName} path: {$pagePath} type: {$pageType}"
            );
        }

        $pageCmsResource = $pageCmsResources[0];

        return $this->rcmPageFromZrcmsPageCmsResource->__invoke(
            $pageCmsResource
        );
    }
}
