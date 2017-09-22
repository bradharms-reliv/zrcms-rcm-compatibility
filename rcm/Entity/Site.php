<?php

namespace ZrcmsRcmCompatibility\Rcm\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Rcm\Entity\Domain;
use Zrcms\ContentCore\Site\Fields\FieldsSiteVersion;
use Zrcms\ContentCore\Site\Model\SiteCmsResource;

/**
 * @deprecated BC ONLY
 * @author     James Jervis - https://github.com/jerv13
 */
class Site extends \Rcm\Entity\Site
{
    public function __construct(
        SiteCmsResource $siteCmsResource,
        Country $country,
        Language $language
    ) {
        $siteVersion = $siteCmsResource->getContentVersion();

        $this->setFavIcon(
            $siteVersion->getProperty(
                FieldsSiteVersion::FAVICON
            )
        );
        $this->setLoginPage(
            $siteVersion->getProperty(
                FieldsSiteVersion::LOGIN_PAGE
            )
        );
        $notAuthorized = $siteVersion->findStatusPage(
            '401',
            [
                'path' => '/not-authorized',
                'type' => 'render',
            ]
        );
        $notAuthorizedPath = (array_key_exists('path', $notAuthorized) ? $notAuthorized['path'] : '/not-authorized');
        $this->setNotAuthorizedPage($notAuthorizedPath);
        $notFound = $siteVersion->findStatusPage(
            '401',
            [
                'path' => '/not-found',
                'type' => 'render',
            ]
        );
        $notFoundPath = (array_key_exists('path', $notFound) ? ltrim($notFound['path'], "/") : '/not-found');
        $this->setNotFoundPage(
            $notFoundPath
        );
        $this->setSiteId(
            $siteCmsResource->getId()
        );
        $this->setSiteTitle(
            $siteVersion->getProperty(
                FieldsSiteVersion::TITLE
            )
        );

        $this->setStatus(Site::STATUS_ACTIVE);

        $this->setTheme(
            $siteVersion->getProperty(
                FieldsSiteVersion::TITLE
            )
        );

        $domain = new \ZrcmsRcmCompatibility\Rcm\Entity\Domain(
            $siteCmsResource,
            $this
        );

        $this->pages = new ArrayCollection();
        $this->sitePlugins = new ArrayCollection();
        $this->containers = new ArrayCollection();

        // Removed this because it is dangerous
        if ($domain instanceof Domain) {
            $this->setDomain($domain);
        }

        // Removed this because it is dangerous
        if ($country instanceof Country) {
            $this->setCountry($country);
        }

        // Removed this because it is dangerous
        if ($language instanceof Language) {
            $this->setLanguage($language);
        }

        $this->createdDate = $siteVersion->getCreatedDateObject();

        $this->createdByUserId = $siteVersion->getCreatedByUserId();

        $this->createdReason = $siteVersion->getCreatedReason();

        $this->modifiedDate = $siteVersion->getCreatedDateObject();

        $this->modifiedByUserId = $siteVersion->getCreatedByUserId();

        $this->modifiedReason = $siteVersion->getCreatedReason();
    }
}
