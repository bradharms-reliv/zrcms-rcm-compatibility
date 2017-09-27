<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Page;

use Rcm\Entity\Page;
use Rcm\Page\PageTypes\PageTypes;
use Zrcms\ContentCore\Page\Api\Repository\FindPageContainerCmsResourceBySitePath;
use Zrcms\ContentCore\Page\Api\Repository\FindPageContainerCmsResourcesBy;
use Zrcms\ContentCore\Page\Api\Repository\FindPageTemplateCmsResourceBySitePath;
use Zrcms\ContentCore\Page\Api\Repository\FindPageTemplateCmsResourcesBy;
use ZrcmsRcmCompatibility\RcmAdapter\PreparePath;
use ZrcmsRcmCompatibility\RcmAdapter\RcmPageFromZrcmsPageContainerCmsResource;

/**
 * @deprecated BC ONLY
 */
class FindPage extends \Rcm\Api\Repository\Page\FindPage
{
    /**
     * @var FindPageContainerCmsResourcesBy
     */
    protected $findPageContainerCmsResourcesBy;

    /**
     * @var FindPageTemplateCmsResourcesBy
     */
    protected $findPageTemplateCmsResourcesBy;

    /**
     * @var RcmPageFromZrcmsPageContainerCmsResource
     */
    protected $rcmPageFromZrcmsPageContainerCmsResource;

    /**
     * @param FindPageContainerCmsResourcesBy          $findPageContainerCmsResourcesBy
     * @param FindPageTemplateCmsResourcesBy           $findPageTemplateCmsResourcesBy
     * @param RcmPageFromZrcmsPageContainerCmsResource $rcmPageFromZrcmsPageContainerCmsResource
     */
    public function __construct(
        FindPageContainerCmsResourcesBy $findPageContainerCmsResourcesBy,
        FindPageTemplateCmsResourcesBy $findPageTemplateCmsResourcesBy,
        RcmPageFromZrcmsPageContainerCmsResource $rcmPageFromZrcmsPageContainerCmsResource
    ) {
        $this->findPageContainerCmsResourcesBy = $findPageContainerCmsResourcesBy;
        $this->findPageTemplateCmsResourcesBy = $findPageTemplateCmsResourcesBy;
        $this->rcmPageFromZrcmsPageContainerCmsResource = $rcmPageFromZrcmsPageContainerCmsResource;
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
            $pageCmsResources = $this->findPageContainerCmsResourcesBy->__invoke(
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

        return $this->rcmPageFromZrcmsPageContainerCmsResource->__invoke(
            $pageCmsResource
        );
    }
}
