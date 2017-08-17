<?php

namespace ZrcmsRcmCompatibility\Rcm\Adapter;

use Zrcms\ContentCore\Basic\Api\Repository\FindBasicComponent;
use Zrcms\ContentCore\Site\Api\Repository\FindSiteCmsResourceVersionByHost;
use Zrcms\ContentCore\Site\Model\PropertiesSiteVersion;
use Zrcms\ContentCountry\Model\CountriesComponent;
use Zrcms\ContentLanguage\Model\LanguagesComponent;
use ZrcmsRcmCompatibility\Rcm\Entity\Country;
use ZrcmsRcmCompatibility\Rcm\Entity\Language;
use ZrcmsRcmCompatibility\Rcm\Entity\Site;

/**
 * @deprecated BC ONLY
 * @author James Jervis - https://github.com/jerv13
 */
class RcmSiteFromHost
{
    /**
     * @param FindSiteCmsResourceVersionByHost $findSiteCmsResourceVersionByHost
     * @param FindBasicComponent               $findBasicComponent
     */
    public function __construct(
        FindSiteCmsResourceVersionByHost $findSiteCmsResourceVersionByHost,
        FindBasicComponent $findBasicComponent
    ) {
        $this->findSiteCmsResourceVersionByHost = $findSiteCmsResourceVersionByHost;

        $this->findBasicComponent = $findBasicComponent;
    }

    /**
     * @param string $host
     * @param array  $options
     *
     * @return Site
     */
    public function __invoke(
        string $host,
        array $options = []
    ) {
        $siteCmsResourceVersion = $this->findSiteCmsResourceVersionByHost->__invoke(
            $host
        );

        $zrSiteResource = $siteCmsResourceVersion->getCmsResource();
        $zrSiteVersion = $siteCmsResourceVersion->getVersion();

        $countryIso3 = $zrSiteVersion->getProperty(
            PropertiesSiteVersion::COUNTRY_ISO3
        );

        /** @var CountriesComponent $countriesComponent */
        $countriesComponent = $this->findBasicComponent->__invoke(
            'zrcms-countries'
        );

        $zrCountry = $countriesComponent->getCountry($countryIso3);

        $country = new Country(
            $zrCountry,
            $countriesComponent->getCreatedByUserId(),
            $countriesComponent->getCreatedReason()
        );

        $languageIso6392t = $zrSiteVersion->getProperty(
            PropertiesSiteVersion::LANGUAGE_ISO_939_2T
        );

        /** @var LanguagesComponent $languagesComponent */
        $languagesComponent = $this->findBasicComponent->__invoke(
            'zrcms-languages'
        );

        $zrLanguage = $languagesComponent->getLanguage($languageIso6392t);

        $language = new Language(
            $zrLanguage,
            $languagesComponent->getCreatedByUserId(),
            $languagesComponent->getCreatedReason()
        );

        return new Site(
            $zrSiteResource,
            $zrSiteVersion,
            $country,
            $language
        );
    }
}
