<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Page;

use Rcm\Page\PageTypes\PageTypes;
use Zrcms\CorePage\Api\CmsResourceHistory\FindPageCmsResourceHistoryBy;
use ZrcmsRcmCompatibility\RcmAdapter\PreparePath;
use ZrcmsRcmCompatibility\RcmAdapter\RcmPageRevisionsFromZrcmsPageCmsResourceHistoryList;

/**
 * @todo       CONVERT THIS TO ZRCMS ADAPTER
 * @deprecated BC ONLY
 */
class FindRevisionList
{
    protected $findPageCmsResourceHistoryBy;
    protected $rcmPageRevisionsFromZrcmsPageCmsResourceHistoryList;

    /**
     * @param FindPageCmsResourceHistoryBy $findPageCmsResourceHistoryBy
     */
    public function __construct(
        FindPageCmsResourceHistoryBy $findPageCmsResourceHistoryBy,
        RcmPageRevisionsFromZrcmsPageCmsResourceHistoryList $rcmPageRevisionsFromZrcmsPageCmsResourceHistoryList
    ) {
        $this->findPageCmsResourceHistoryBy = $findPageCmsResourceHistoryBy;
        $this->rcmPageRevisionsFromZrcmsPageCmsResourceHistoryList
            = $rcmPageRevisionsFromZrcmsPageCmsResourceHistoryList;
    }

    /**
     * @param int    $siteId
     * @param string $pageName
     * @param string $pageType
     * @param bool   $published
     * @param int    $limit
     *
     * @return \ZrcmsRcmCompatibility\Rcm\Entity\Revision[]
     */
    public function __invoke(
        int $siteId,
        string $pageName,
        string $pageType = PageTypes::NORMAL,
        bool $published = false,
        int $limit = 10
    ) {
        $pageCmsResourceHistoryList = $this->findPageCmsResourceHistoryBy->__invoke(
            [
                'siteCmsResourceId' => $siteId,
                'path' => PreparePath::invoke($pageName)
            ],
            null,
            $limit
        );

        return $this->rcmPageRevisionsFromZrcmsPageCmsResourceHistoryList->__invoke(
            $pageCmsResourceHistoryList
        );
    }
}
