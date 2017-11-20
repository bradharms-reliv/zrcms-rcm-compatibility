<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Site;

use Doctrine\ORM\EntityManager;
use Rcm\Entity\Site;
use Zrcms\Content\Api\Action\PublishCmsResource;
use Zrcms\Content\Api\Action\UnpublishCmsResource;
use Zrcms\ContentCore\Site\Api\Repository\FindSiteCmsResource;
use Zrcms\ContentCore\Site\Fields\FieldsSiteVersion;
use Zrcms\ContentCore\Site\Model\SiteCmsResource;
use Zrcms\ContentCore\Site\Model\SiteVersionBasic;

/**
 * @deprecated BC ONLY
 */
class SetTheme
{
    protected $findSiteCmsResource;

    /**
     * @param FindSiteCmsResource  $findSiteCmsResource
     * @param PublishCmsResource   $publishCmsResource
     * @param UnpublishCmsResource $unpublishCmsResource
     */
    public function __construct(
        FindSiteCmsResource $findSiteCmsResource,
        PublishCmsResource $publishCmsResource,
        UnpublishCmsResource $unpublishCmsResource
    ) {
        $this->findSiteCmsResource = $findSiteCmsResource;
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

        $site->setModifiedByUserId($modifiedUserId, $modifiedReason);
        $this->em->flush($site);
    }
}
