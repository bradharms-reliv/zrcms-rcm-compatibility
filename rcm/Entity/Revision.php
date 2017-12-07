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
    public function __construct(
        ContentVersion $contentVersion,
        CmsResourceHistory $lastPublishAction,
        string $md5
    ) {
        $this->revisionId = $contentVersion->getId();

        $this->author = $contentVersion->getCreatedByUserId();

        $this->publishedDate = $lastPublishAction->getCreatedDate();

        $this->published = $lastPublishAction->getAction() == 'published' ? true : false;

        $this->md5 = $md5;

        $this->pluginWrappers = new ArrayCollection();

        $this->createdDate = $contentVersion->getCreatedDateObject();

        $this->createdByUserId = $contentVersion->getCreatedByUserId();

        $this->createdReason = $contentVersion->getCreatedReason();

        $this->modifiedDate = $lastPublishAction->getCreatedDateObject();

        $this->modifiedByUserId = $lastPublishAction->getCreatedByUserId();

        $this->modifiedReason = $lastPublishAction->getCreatedReason();
    }
}
