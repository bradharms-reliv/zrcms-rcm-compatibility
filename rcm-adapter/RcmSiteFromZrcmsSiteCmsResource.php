<?php

namespace ZrcmsRcmCompatibility\RcmAdapter;

use Zrcms\Core\Api\Component\FindComponent;
use Zrcms\CoreCountry\Model\CountriesComponent;
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
     * @param FindComponent $findComponent
     */
    public function __construct(
        FindComponent $findComponent
    ) {
        $this->findComponent = $findComponent;
    }

    /**
     * @param SiteCmsResource $siteCmsResource
     * @param array           $options
     *
     * @return Site
     */
    public function __invoke(
        SiteCmsResource $siteCmsResource,
        array $options = []
    ) {
        $zrSiteVersion = $siteCmsResource->getContentVersion();

        $countryIso3 = $zrSiteVersion->getProperty(
            FieldsSiteVersion::COUNTRY_ISO3
        );

        /** @var CountriesComponent $countriesComponent */
        $countriesComponent = $this->findComponent->__invoke(
            'basic',
            'zrcms-countries'
        );

        $zrCountry = $countriesComponent->getCountry($countryIso3);

        $country = new Country(
            $zrCountry,
            $countriesComponent->getCreatedByUserId(),
            $countriesComponent->getCreatedReason()
        );

        $languageIso6392t = $zrSiteVersion->getProperty(
            FieldsSiteVersion::LANGUAGE_ISO_939_2T
        );

        /** @var LanguagesComponent $languagesComponent */
        $languagesComponent = $this->findComponent->__invoke(
            'basic',
            'zrcms-languages'
        );

        $zrLanguage = $languagesComponent->getLanguage($languageIso6392t);

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
