<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Page;

use Rcm\Api\Repository\Options;
use Rcm\Entity\Page;
use Rcm\Exception\InvalidArgumentException;
use Rcm\Exception\PageNotFoundException;
use Rcm\Exception\SiteNotFoundException;
use Reliv\ArrayProperties\Property;
use Zrcms\CorePage\Api\CmsResource\FindPageCmsResource;
use Zrcms\CorePage\Api\CmsResource\UpsertPageCmsResource;
use Zrcms\CorePage\Api\Content\InsertPageVersion;
use Zrcms\CorePage\Fields\FieldsPageVersion;
use Zrcms\CorePage\Model\PageVersion;
use Zrcms\CorePage\Model\PageVersionBasic;
use Zrcms\CoreSite\Api\CmsResource\FindSiteCmsResource;
use ZrcmsRcmCompatibility\RcmAdapter\PreparePath;
use ZrcmsRcmCompatibility\RcmAdapter\RcmPageFromZrcmsPageCmsResource;

/**
 * @deprecated BC ONLY
 */
class CopyPage extends \Rcm\Api\Repository\Page\CopyPage
{
    const OPTION_PUBLISH_NEW_PAGE = 'publishNewPage';

    protected $findSiteCmsResource;
    protected $findPageCmsResource;
    protected $insertPageVersion;
    protected $upsertPageCmsResource;
    protected $rcmPageFromZrcmsPageCmsResource;

    /**
     * @param FindSiteCmsResource             $findSiteCmsResource
     * @param FindPageCmsResource             $findPageCmsResource
     * @param InsertPageVersion               $insertPageVersion
     * @param UpsertPageCmsResource           $upsertPageCmsResource
     * @param RcmPageFromZrcmsPageCmsResource $rcmPageFromZrcmsPageCmsResource
     */
    public function __construct(
        FindSiteCmsResource $findSiteCmsResource,
        FindPageCmsResource $findPageCmsResource,
        InsertPageVersion $insertPageVersion,
        UpsertPageCmsResource $upsertPageCmsResource,
        RcmPageFromZrcmsPageCmsResource $rcmPageFromZrcmsPageCmsResource
    ) {
        $this->findSiteCmsResource = $findSiteCmsResource;
        $this->findPageCmsResource = $findPageCmsResource;
        $this->insertPageVersion = $insertPageVersion;
        $this->upsertPageCmsResource = $upsertPageCmsResource;
        $this->rcmPageFromZrcmsPageCmsResource = $rcmPageFromZrcmsPageCmsResource;
    }

    /**
     * @param       $destinationSiteId
     * @param       $pageToCopyId
     * @param array $pageData
     * @param array $options
     *
     * @return Page
     * @throws \Throwable
     * @throws \Reliv\ArrayProperties\Exception\ArrayPropertyException
     */
    public function __invoke(
        $destinationSiteId,
        $pageToCopyId,
        array $pageData,
        array $options = []
    ): Page {
        $destinationSite = $this->findSiteCmsResource->__invoke(
            $destinationSiteId
        );

        if (empty($destinationSite)) {
            throw new SiteNotFoundException(
                'Destination site not found with ID: ' . $destinationSiteId
            );
        }

        $pageCmsResourceToCopy = $this->findPageCmsResource->__invoke(
            $pageToCopyId
        );

        if (empty($pageToCopy)) {
            throw new PageNotFoundException(
                'Page to copy not found with ID: ' . $pageToCopyId
            );
        }

        $properties = $this->buildProperties(
            $pageData,
            $destinationSiteId,
            $pageCmsResourceToCopy->getContentVersion()
        );

        $createdByUserId = Property::getRequired(
            $pageData,
            'createdByUserId'
        );

        $createdReason = Property::get(
            $pageData,
            'createdReason',
            'Copy page in ' . get_class($this)
        );

        $publishNewPage = Options::get(
            $options,
            static::OPTION_PUBLISH_NEW_PAGE,
            false
        );

        $newPageContentVersion = new PageVersionBasic(
            null,
            $properties,
            $createdByUserId,
            $createdReason
        );

        $newPageContentVersion = $this->insertPageVersion->__invoke(
            $newPageContentVersion
        );

        $newPageCmsResource = $this->upsertPageCmsResource->__invoke(
            null,
            $publishNewPage,
            $newPageContentVersion->getId(),
            $createdByUserId,
            $createdReason
        );

        return $this->rcmPageFromZrcmsPageCmsResource->__invoke(
            $newPageCmsResource
        );
    }

    /**
     * @param array       $rcmPageData
     * @param string      $destinationSiteId
     * @param PageVersion $pageVersionToCopy
     *
     * @return array
     */
    protected function buildProperties(
        array $rcmPageData,
        string $destinationSiteId,
        PageVersion $pageVersionToCopy
    ): array {
        if (empty($pageData['name'])) {
            throw new InvalidArgumentException(
                'Missing needed information (name) to create page copy.'
            );
        }

        $path = PreparePath::invoke($pageData['name']);
        unset($pageData['name']);

        $pageVersionProperties = [];

        $pageVersionProperties[FieldsPageVersion::SITE_CMS_RESOURCE_ID] = $destinationSiteId;
        $pageVersionProperties[FieldsPageVersion::PATH] = $path;
        $pageVersionProperties[FieldsPageVersion::TITLE] = Property::get(
            $rcmPageData,
            FieldsPageVersion::TITLE,
            $pageVersionToCopy->getTitle()
        );
        $pageVersionProperties[FieldsPageVersion::DESCRIPTION] = Property::get(
            $rcmPageData,
            FieldsPageVersion::DESCRIPTION,
            $pageVersionToCopy->getDescription()
        );
        $pageVersionProperties[FieldsPageVersion::KEYWORDS] = Property::get(
            $rcmPageData,
            FieldsPageVersion::KEYWORDS,
            $pageVersionToCopy->getKeywords()
        );
        $pageVersionProperties[FieldsPageVersion::LAYOUT] = Property::get(
            $rcmPageData,
            FieldsPageVersion::LAYOUT,
            $pageVersionToCopy->findProperty(FieldsPageVersion::LAYOUT)
        );
        $pageVersionProperties[FieldsPageVersion::CONTAINERS_DATA] = Property::get(
            $rcmPageData,
            FieldsPageVersion::CONTAINERS_DATA,
            $pageVersionToCopy->getContainersData()
        );
        $pageVersionProperties[FieldsPageVersion::RENDER_TAGS_GETTER] = Property::get(
            $rcmPageData,
            FieldsPageVersion::RENDER_TAGS_GETTER,
            $pageVersionToCopy->findProperty(FieldsPageVersion::RENDER_TAGS_GETTER)
        );

        if (empty($pageData['createdByUserId'])) {
            throw new InvalidArgumentException(
                'Missing needed information (createdByUserId) to create page copy.'
            );
        }

        if (empty($pageData['createdReason'])) {
            $pageData['createdReason'] = 'Copy page in ' . get_class($this);
        }
    }
}
