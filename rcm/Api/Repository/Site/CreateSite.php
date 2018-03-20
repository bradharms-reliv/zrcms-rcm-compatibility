<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Site;

use Rcm\Api\Repository\Options;
use Rcm\Entity\Site;
use Rcm\Tracking\Model\Tracking;
use Zrcms\CoreSite\Api\CmsResource\CreateSiteCmsResource;
use Zrcms\CoreSite\Api\Content\InsertSiteVersion;
use Zrcms\CoreSite\Model\SiteVersionBasic;
use Zrcms\LocaleZrcms\Api\LocaleFromCountryLanguage;
use ZrcmsRcmCompatibility\RcmAdapter\ConvertLayoutName;
use ZrcmsRcmCompatibility\RcmAdapter\RcmSiteFromZrcmsSiteCmsResource;

/**
 * @deprecated BC ONLY
 */
class CreateSite extends \Rcm\Api\Repository\Site\CreateSite
{
    protected $localeFromCountryLanguage;
    protected $insertSiteVersion;
    protected $createSiteCmsResource;
    protected $rcmSiteFromZrcmsSiteCmsResource;

    /**
     * @param LocaleFromCountryLanguage       $localeFromCountryLanguage
     * @param InsertSiteVersion               $insertSiteVersion
     * @param CreateSiteCmsResource           $createSiteCmsResource
     * @param RcmSiteFromZrcmsSiteCmsResource $rcmSiteFromZrcmsSiteCmsResource
     */
    public function __construct(
        LocaleFromCountryLanguage $localeFromCountryLanguage,
        InsertSiteVersion $insertSiteVersion,
        CreateSiteCmsResource $createSiteCmsResource,
        RcmSiteFromZrcmsSiteCmsResource $rcmSiteFromZrcmsSiteCmsResource
    ) {
        $this->localeFromCountryLanguage = $localeFromCountryLanguage;
        $this->insertSiteVersion = $insertSiteVersion;
        $this->createSiteCmsResource = $createSiteCmsResource;
        $this->rcmSiteFromZrcmsSiteCmsResource = $rcmSiteFromZrcmsSiteCmsResource;
    }

    /**
     * @param array  $properties
     * @param string $createdByUserId
     * @param string $createdReason
     * @param array  $options
     *
     * @return Site
     * @throws \Exception
     */
    public function __invoke(
        array $properties,
        string $createdByUserId,
        string $createdReason = Tracking::UNKNOWN_REASON,
        array $options = []
    ): Site {
        $this->assertValidProperties($properties);

        $siteVersionProperties = $this->convertSiteProperties($properties);

        $siteVersion = new SiteVersionBasic(
            null,
            $siteVersionProperties,
            $createdByUserId,
            $createdReason
        );

        $siteVersion = $this->insertSiteVersion->__invoke(
            $siteVersion
        );

        $status = Options::get(
            $properties,
            self::PROPERTY_STATUS,
            self::DEFAULT_STATUS
        );

        $published = ($status === Site::STATUS_ACTIVE);

        $siteCmsResource = $this->createSiteCmsResource->__invoke(
            null,
            $published,
            $siteVersion->getId(),
            $createdByUserId,
            $createdReason
        );

        $newSite = $this->rcmSiteFromZrcmsSiteCmsResource->__invoke(
            $siteCmsResource
        );

        return $newSite;
    }

    /**
     * @param array $properties
     *
     * @return array
     */
    protected function convertSiteProperties(array $properties): array
    {
        $host = Options::get(
            $properties,
            self::PROPERTY_HOST
        );

        $languageIso9392t = Options::get(
            $properties,
            self::PROPERTY_LANGUAGE_ISO_939_2T
        );

        $countryIso3 = Options::get(
            $properties,
            self::PROPERTY_COUNTRY_ISO3
        );

        $locale = $this->localeFromCountryLanguage->__invoke(
            $languageIso9392t,
            $countryIso3
        );

        $theme = Options::get(
            $properties,
            self::PROPERTY_THEME_NAME,
            self::DEFAULT_THEME_NAME
        );

        $layout = Options::get(
            $properties,
            self::PROPERTY_LAYOUT,
            ''
        );

        $layout = ConvertLayoutName::invoke($layout);

        $title = Options::get(
            $properties,
            self::PROPERTY_TITLE
        );

        $favIcon = Options::get(
            $properties,
            self::PROPERTY_FAVICON,
            self::DEFAULT_FAVICON
        );

        $loginPage = Options::get(
            $properties,
            self::PROPERTY_LOGIN_PAGE,
            self::DEFAULT_LOGIN_PAGE
        );

        $notAuthorizedPage = Options::get(
            $properties,
            self::PROPERTY_NOT_AUTHORIZED_PAGE,
            self::DEFAULT_NOT_AUTHORIZED_PAGE
        );

        $notFoundPage = Options::get(
            $properties,
            self::PROPERTY_NOT_FOUND_PAGE,
            self::DEFAULT_NOT_FOUND_PAGE
        );

        return [
            'host' => $host,
            'theme' => $theme,
            'layout' => $layout,
            'locale' => $locale,
            'languageIso9392t' => $languageIso9392t,
            'countryIso3' => $countryIso3,
            "favIcon" => $favIcon,
            "loginPage" => $loginPage,
            "statusPages" => [
                "401" => [
                    'path' => $notAuthorizedPage,
                    'type' => 'redirect',
                ],
                "404" => [
                    'path' => $notFoundPage,
                    'type' => 'render',
                ],
            ],
            'title' => $title,
        ];
    }
}
