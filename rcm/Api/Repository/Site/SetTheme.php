<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Site;

use Zrcms\CoreSite\Api\CmsResource\FindSiteCmsResource;
use Zrcms\CoreSite\Api\CmsResource\UpdateSiteCmsResource;
use Zrcms\CoreSite\Api\Content\InsertSiteVersion;
use Zrcms\CoreSite\Fields\FieldsSiteVersion;
use Zrcms\CoreSite\Model\SiteCmsResource;
use Zrcms\CoreSite\Model\SiteVersionBasic;

/**
 * @deprecated BC ONLY
 */
class SetTheme
{
    protected $findSiteCmsResource;
    protected $insertSiteVersion;
    protected $updateSiteCmsResource;

    /**
     * @param FindSiteCmsResource   $findSiteCmsResource
     * @param InsertSiteVersion     $insertSiteVersion
     * @param UpdateSiteCmsResource $updateSiteCmsResource
     */
    public function __construct(
        FindSiteCmsResource $findSiteCmsResource,
        InsertSiteVersion $insertSiteVersion,
        UpdateSiteCmsResource $updateSiteCmsResource
    ) {
        $this->findSiteCmsResource = $findSiteCmsResource;
        $this->insertSiteVersion = $insertSiteVersion;
        $this->updateSiteCmsResource = $updateSiteCmsResource;
    }

    /**
     * @param string $siteId
     * @param string $themeName
     * @param string $modifiedUserId
     * @param string $modifiedReason
     *
     * @return void
     * @throws \Zrcms\Core\Exception\CmsResourceNotExists
     * @throws \Zrcms\Core\Exception\ContentVersionNotExists
     */
    public function __invoke(
        string $siteId,
        string $themeName,
        string $modifiedUserId,
        string $modifiedReason
    ) {
        /** @var SiteCmsResource $siteCmsResource */
        $siteCmsResource = $this->findSiteCmsResource->__invoke(
            $siteId
        );
        $siteVersion = $siteCmsResource->getContentVersion();
        $siteVersionProperties = $siteVersion->getProperties();
        $siteVersionProperties[FieldsSiteVersion::THEME_NAME] = $themeName;

        $newSiteVersion = new SiteVersionBasic(
            null,
            $siteVersionProperties,
            $modifiedUserId,
            $modifiedReason
        );

        $newSiteVersion = $this->insertSiteVersion->__invoke(
            $newSiteVersion
        );

        $siteCmsResource->setContentVersion(
            $newSiteVersion,
            $modifiedUserId,
            $modifiedReason
        );

        $this->updateSiteCmsResource->__invoke(
            $siteCmsResource->getId(),
            $siteCmsResource->isPublished(),
            $newSiteVersion->getId(),
            $modifiedUserId,
            $modifiedReason
        );
    }
}
