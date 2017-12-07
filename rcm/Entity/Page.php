<?php

namespace ZrcmsRcmCompatibility\Rcm\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Rcm\Page\PageTypes\PageTypes;
use Zrcms\CorePage\Fields\FieldsPageVersion;
use Zrcms\CorePage\Model\PageCmsResource;
use Zrcms\CorePage\Model\PageCmsResourceHistory;
use Zrcms\CorePage\Model\PageVersion;
use Zrcms\CorePage\Model\PageTemplateCmsResource;

/**
 * @deprecated BC ONLY
 * @author     James Jervis - https://github.com/jerv13
 */
class Page extends \Rcm\Entity\Page
{
    /**
     * @param PageCmsResource                    $pageCmsResource
     * @param Site                               $site
     * @param PageCmsResourceHistory|null $lastPublished
     * @param string                             $pageType
     */
    public function __construct(
        PageCmsResource $pageCmsResource,
        Site $site,
        $lastPublished = null,
        $pageType = PageTypes::NORMAL
    ) {
        /** @var PageVersion $pageVersion */
        $pageVersion = $pageCmsResource->getContentVersion();

        $this->pageId = $pageCmsResource->getId();

        $this->name = ltrim($pageCmsResource->getPath(), '/');

        $this->author = $pageVersion->getCreatedByUserId();

        if($lastPublished) {
            $this->lastPublished = $lastPublished->getCreatedDateObject();
        }

        $this->pageLayout = $pageVersion->getProperty(
            FieldsPageVersion::LAYOUT,
            null
        );

        $this->siteLayoutOverride = $this->pageLayout;

        $this->pageTitle = $pageVersion->getTitle();

        $this->description = $pageVersion->getDescription();

        $this->keywords = $pageVersion->getKeywords();

        $this->publishedRevision = null;

        $this->publishedRevisionId = null;

        $this->stagedRevision = null;

        $this->stagedRevisionId = null;

        // @todo parse this or get from properties also
        $this->pageType = $pageType;

        if ($pageCmsResource instanceof PageTemplateCmsResource) {
            $this->pageType = PageTypes::TEMPLATE;
        }

        $this->site = $site;

        $this->siteId = $site->getSiteId();

        $this->revisions = new ArrayCollection();

        // NOT supported in ZRCMS
        $this->parent = null;
        $this->parentId = null;

        $this->createdDate = $pageVersion->getCreatedDateObject();

        $this->createdByUserId = $pageVersion->getCreatedByUserId();

        $this->createdReason = $pageVersion->getCreatedReason();

        $this->modifiedDate = $pageVersion->getCreatedDateObject();

        $this->modifiedByUserId = $pageVersion->getCreatedByUserId();

        $this->modifiedReason = $pageVersion->getCreatedReason();
    }
}
