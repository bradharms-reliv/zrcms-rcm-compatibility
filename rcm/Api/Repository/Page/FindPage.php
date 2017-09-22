<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Page;

use Rcm\Entity\Page;
use Rcm\Page\PageTypes\PageTypes;
use Zrcms\ContentCore\Page\Api\Repository\FindPageContainerCmsResourceBySitePath;
use Zrcms\ContentCore\Page\Api\Repository\FindPageTemplateCmsResourceBySitePath;
use ZrcmsRcmCompatibility\RcmAdapter\PreparePath;
use ZrcmsRcmCompatibility\RcmAdapter\RcmPageFromZrcmsPageContainerCmsResource;

/**
 * @deprecated BC ONLY
 */
class FindPage extends \Rcm\Api\Repository\Page\FindPage
{
    /**
     * @var FindPageContainerCmsResourceBySitePath
     */
    protected $findPageContainerCmsResourceBySitePath;

    protected $findPageTemplateCmsResourceBySitePath;

    protected $rcmPageFromZrcmsPageContainerCmsResource;

    /**
     * @param FindPageContainerCmsResourceBySitePath   $findPageContainerCmsResourceBySitePath
     * @param FindPageTemplateCmsResourceBySitePath    $findPageTemplateCmsResourceBySitePath
     * @param RcmPageFromZrcmsPageContainerCmsResource $rcmPageFromZrcmsPageContainerCmsResource
     */
    public function __construct(
        FindPageContainerCmsResourceBySitePath $findPageContainerCmsResourceBySitePath,
        FindPageTemplateCmsResourceBySitePath $findPageTemplateCmsResourceBySitePath,
        RcmPageFromZrcmsPageContainerCmsResource $rcmPageFromZrcmsPageContainerCmsResource
    ) {
        $this->findPageContainerCmsResourceBySitePath = $findPageContainerCmsResourceBySitePath;
        $this->findPageTemplateCmsResourceBySitePath = $findPageTemplateCmsResourceBySitePath;
        $this->rcmPageFromZrcmsPageContainerCmsResource = $rcmPageFromZrcmsPageContainerCmsResource;
    }

    /**
     * @param int    $siteId
     * @param string $pageName
     * @param string $pageType
     * @param array  $options
     *
     * @return null|Page
     */
    public function __invoke(
        int $siteId,
        string $pageName,
        string $pageType = PageTypes::NORMAL,
        array $options = []
    ) {
        $pagePath = PreparePath::invoke($pageName);

        if ($pageType == PageTypes::TEMPLATE) {
            $pageCmsResource = $this->findPageTemplateCmsResourceBySitePath->__invoke(
                $siteId,
                $pagePath
            );
        } else {
            $pageCmsResource = $this->findPageContainerCmsResourceBySitePath->__invoke(
                $siteId,
                $pagePath
            );
        }

        return $this->rcmPageFromZrcmsPageContainerCmsResource->__invoke(
            $pageCmsResource
        );
    }
}
