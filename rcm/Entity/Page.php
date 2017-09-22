<?php

namespace ZrcmsRcmCompatibility\Rcm\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Rcm\Page\PageTypes\PageTypes;
use Zrcms\ContentCore\Page\Fields\FieldsPageContainerVersion;
use Zrcms\ContentCore\Page\Model\PageContainerCmsResource;
use Zrcms\ContentCore\Page\Model\PageContainerCmsResourcePublishHistory;
use Zrcms\ContentCore\Page\Model\PageContainerVersion;
use Zrcms\ContentCore\Page\Model\PageTemplateCmsResource;

/**
 * @deprecated BC ONLY
 * @author     James Jervis - https://github.com/jerv13
 */
class Page extends \Rcm\Entity\Page
{
    /**
     * @param PageContainerCmsResource                    $pageCmsResource
     * @param Site                                        $site
     * @param PageContainerCmsResourcePublishHistory|null $lastPublished
     * @param string                                      $pageType
     */
    public function __construct(
        PageContainerCmsResource $pageCmsResource,
        Site $site,
        $lastPublished = null,
        $pageType = PageTypes::NORMAL
    ) {
        /** @var PageContainerVersion $pageContainerVersion */
        $pageContainerVersion = $pageCmsResource->getContentVersion();

        $this->pageId = $pageCmsResource->getId();

        $this->name = ltrim($pageCmsResource->getPath(), '/');

        $this->author = $pageContainerVersion->getCreatedByUserId();

        if($lastPublished) {
            $this->lastPublished = $lastPublished->getCreatedDateObject();
        }

        $this->pageLayout = $pageContainerVersion->getProperty(
            FieldsPageContainerVersion::LAYOUT,
            null
        );

        $this->siteLayoutOverride = $this->pageLayout;

        $this->pageTitle = $pageContainerVersion->getTitle();

        $this->description = $pageContainerVersion->getDescription();

        $this->keywords = $pageContainerVersion->getKeywords();

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

        $this->createdDate = $pageContainerVersion->getCreatedDateObject();

        $this->createdByUserId = $pageContainerVersion->getCreatedByUserId();

        $this->createdReason = $pageContainerVersion->getCreatedReason();

        $this->modifiedDate = $pageContainerVersion->getCreatedDateObject();

        $this->modifiedByUserId = $pageContainerVersion->getCreatedByUserId();

        $this->modifiedReason = $pageContainerVersion->getCreatedReason();
    }
}
