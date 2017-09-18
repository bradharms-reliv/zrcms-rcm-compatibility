<?php

namespace ZrcmsRcmCompatibility\RcmAdapter;

use Zrcms\ContentCore\Basic\Api\Repository\FindBasicComponent;
use Zrcms\ContentCore\Site\Api\Repository\FindSiteCmsResourceByHost;
use Zrcms\ContentCore\Site\Fields\FieldsSiteVersion;
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
     * @param FindSiteCmsResourceByHost $findSiteCmsResourceByHost
     * @param FindBasicComponent               $findBasicComponent
     */
    public function __construct(
        FindSiteCmsResourceByHost $findSiteCmsResourceByHost,
        FindBasicComponent $findBasicComponent
    ) {
        $this->findSiteCmsResourceByHost = $findSiteCmsResourceByHost;

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
        $zrSiteResource = $this->findSiteCmsResourceByHost->__invoke(
            $host
        );

        $zrSiteVersion = $zrSiteResource->getContentVersion();

        $countryIso3 = $zrSiteVersion->getProperty(
            FieldsSiteVersion::COUNTRY_ISO3
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
            FieldsSiteVersion::LANGUAGE_ISO_939_2T
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
