<?php

namespace ZrcmsRcmCompatibility\Rcm\Entity;

use Zrcms\ContentCore\Site\Model\PropertiesSiteVersion;
use Zrcms\ContentCore\Site\Model\SiteCmsResource;
use Zrcms\ContentCore\Site\Model\SiteVersion;

/**
 * @deprecated BC ONLY
 * @author James Jervis - https://github.com/jerv13
 */
class Site extends \Rcm\Entity\Site
{
    public function __construct(
        SiteCmsResource $siteCmsResource,
        SiteVersion $siteVersion,
        Country $country,
        Language $language
    ) {
        $createdByUserId = $siteVersion->getCreatedByUserId();
        $createdReason = $siteVersion->getCreatedReason();
        $domain = $siteCmsResource->getHost();
        $this->setFavIcon(
            $siteVersion->getProperty(
                PropertiesSiteVersion::FAVICON
            )
        );
        $this->setLoginPage(
            $siteVersion->getProperty(
                PropertiesSiteVersion::LOGIN_PAGE
            )
        );
        $this->setNotAuthorizedPage(
            $siteVersion->findStatusPage(
                '401',
                '/not-authorized'
            )
        );
        $this->setNotFoundPage(
            $siteVersion->findStatusPage(
                '401',
                'not-found'
            )
        );
        $this->setSiteId(
            $siteCmsResource->getId()
        );
        $this->setSiteTitle(
            $siteVersion->getProperty(
                PropertiesSiteVersion::TITLE
            )
        );

        $this->setStatus(Site::STATUS_ACTIVE);

        $this->setTheme(
            $siteVersion->getProperty(
                PropertiesSiteVersion::TITLE
            )
        );

        parent::__construct(
            $createdByUserId,
            $createdReason,
            $domain,
            $country,
            $language
        );
    }
}
