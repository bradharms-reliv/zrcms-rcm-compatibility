<?php

namespace ZrcmsRcmCompatibility\Rcm\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Zrcms\Core\Model\Action;
use Zrcms\Core\Model\CmsResourceHistory;
use Zrcms\Core\Model\ContentVersion;

/**
 * @deprecated BC ONLY
 * @author     James Jervis - https://github.com/jerv13
 */
class Revision extends \Rcm\Entity\Revision
{
    /**
     * @param CmsResourceHistory $cmsResourceHistory
     *
     * @throws \Zrcms\Core\Exception\TrackingInvalid
     */
    public function __construct(
        CmsResourceHistory $cmsResourceHistory
    ) {
        $contentVersion = $cmsResourceHistory->getContentVersion();

        $this->revisionId = $contentVersion->getId();

        $this->author = $contentVersion->getCreatedByUserId();

        $this->publishedDate = $cmsResourceHistory->getCreatedDate();

        $this->published = $cmsResourceHistory->getAction() == 'published' ? true : false;

        $this->md5 = 'no-md5';

        $this->pluginWrappers = new ArrayCollection();

        $this->createdDate = $contentVersion->getCreatedDateObject();

        $this->createdByUserId = $contentVersion->getCreatedByUserId();

        $this->createdReason = $contentVersion->getCreatedReason();

        $this->modifiedDate = $cmsResourceHistory->getCreatedDateObject();

        $this->modifiedByUserId = $cmsResourceHistory->getCreatedByUserId();

        $this->modifiedReason = $cmsResourceHistory->getCreatedReason();
    }
}
