<?php

namespace ZrcmsRcmCompatibility\RcmAdapter;

use Zrcms\CorePage\Model\PageCmsResourceHistory;
use ZrcmsRcmCompatibility\Rcm\Entity\Revision;

/**
 * @deprecated BC ONLY
 * @author     James Jervis - https://github.com/jerv13
 */
class RcmPageRevisionsFromZrcmsPageCmsResourceHistoryList
{
    /**
     * @param PageCmsResourceHistory[] $pageCmsResourceHistoryList
     *
     * @return Revision[]
     */
    public function __invoke(
        array $pageCmsResourceHistoryList
    ) {
        $revisions = [];

        foreach ($pageCmsResourceHistoryList as $pageCmsResourceHistory) {
            $revisions[] = new Revision(
                $pageCmsResourceHistory
            );
        }

        return $revisions;
    }
}
