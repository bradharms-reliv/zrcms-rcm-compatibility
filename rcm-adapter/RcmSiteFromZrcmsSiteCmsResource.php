<?php

namespace ZrcmsRcmCompatibility\RcmAdapter;

use Zrcms\Core\Api\Component\FindComponent;
use Zrcms\CoreCountry\Api\GetDefaultCountry;
use Zrcms\CoreCountry\Model\CountriesComponent;
use Zrcms\CoreLanguage\Api\GetDefaultLanguage;
use Zrcms\CoreLanguage\Model\LanguagesComponent;
use Zrcms\CoreSite\Fields\FieldsSiteVersion;
use Zrcms\CoreSite\Model\SiteCmsResource;
use ZrcmsRcmCompatibility\Rcm\Entity\Country;
use ZrcmsRcmCompatibility\Rcm\Entity\Language;
use ZrcmsRcmCompatibility\Rcm\Entity\Site;

/**
 * @deprecated BC ONLY
 * @author     James Jervis - https://github.com/jerv13
 */
class RcmSiteFromZrcmsSiteCmsResource
{
    /**
     * @param FindComponent      $findComponent
     * @param GetDefaultCountry  $getDefaultCountry
     * @param GetDefaultLanguage $getDefaultLanguage
     */
    public function __construct(
        FindComponent $findComponent,
        GetDefaultCountry $getDefaultCountry,
        GetDefaultLanguage $getDefaultLanguage
    ) {
        $this->findComponent = $findComponent;
        $this->getDefaultCountry = $getDefaultCountry;
        $this->getDefaultLanguage = $getDefaultLanguage;
    }

    /**
     * @param SiteCmsResource $siteCmsResource
     * @param array           $options
     *
     * @return Site
     * @throws \Exception
     * @throws \Zrcms\Core\Exception\TrackingInvalid
     */
    public function __invoke(
        SiteCmsResource $siteCmsResource,
        array $options = []
    ) {
        $zrSiteVersion = $siteCmsResource->getContentVersion();

        $countryIso3 = $zrSiteVersion->findProperty(
            FieldsSiteVersion::COUNTRY_ISO3
        );

        /** @var CountriesComponent $countriesComponent */
        $countriesComponent = $this->findComponent->__invoke(
            'basic',
            'zrcms-countries'
        );

        $zrCountry = $countriesComponent->findCountry($countryIso3);

        if (empty($zrCountry)) {
            $zrCountry = $this->getDefaultCountry->__invoke();
        }

        $country = new Country(
            $zrCountry,
            $countriesComponent->getCreatedByUserId(),
            $countriesComponent->getCreatedReason()
        );

        $languageIso6392t = $zrSiteVersion->findProperty(
            FieldsSiteVersion::LANGUAGE_ISO_939_2T
        );

        /** @var LanguagesComponent $languagesComponent */
        $languagesComponent = $this->findComponent->__invoke(
            'basic',
            'zrcms-languages'
        );

        $zrLanguage = $languagesComponent->findLanguage($languageIso6392t);

        if (empty($zrLanguage)) {
            $zrLanguage = $this->getDefaultLanguage->__invoke();
        }

        $language = new Language(
            $zrLanguage,
            $languagesComponent->getCreatedByUserId(),
            $languagesComponent->getCreatedReason()
        );

        return new Site(
            $siteCmsResource,
            $country,
            $language
        );
    }
}
