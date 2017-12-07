<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Site;

use Zrcms\CoreSite\Api\CmsResource\UpsertSiteCmsResource;
use Zrcms\CoreSite\Api\CmsResource\FindSiteCmsResource;
use Zrcms\CoreSite\Fields\FieldsSiteVersion;
use Zrcms\CoreSite\Model\SiteCmsResource;
use Zrcms\CoreSite\Model\SiteVersionBasic;

/**
 * @deprecated BC ONLY
 */
class SetTheme
{
    protected $findSiteCmsResource;
    protected $upsertSiteCmsResource;

    /**
     * @param FindSiteCmsResource   $findSiteCmsResource
     * @param UpsertSiteCmsResource $upsertSiteCmsResource
     */
    public function __construct(
        FindSiteCmsResource $findSiteCmsResource,
        UpsertSiteCmsResource $upsertSiteCmsResource
    ) {
        $this->findSiteCmsResource = $findSiteCmsResource;
        $this->upsertSiteCmsResource = $upsertSiteCmsResource;
    }

    /**
     * @param string $siteId
     * @param string $themeName
     * @param string $modifiedUserId
     * @param string $modifiedReason
     *
     * @return void
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

        $siteCmsResource->setContentVersion(
            $newSiteVersion,
            $modifiedUserId,
            $modifiedReason
        );

        $this->upsertSiteCmsResource->__invoke(
            $siteCmsResource,
            $modifiedUserId,
            $modifiedReason
        );
    }
}
