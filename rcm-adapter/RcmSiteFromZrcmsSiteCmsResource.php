<?php

namespace ZrcmsRcmCompatibility\RcmAdapter;

use Zrcms\ContentCore\Basic\Api\Repository\FindBasicComponent;
use Zrcms\ContentCore\Site\Fields\FieldsSiteVersion;
use Zrcms\ContentCore\Site\Model\SiteCmsResource;
use Zrcms\ContentCountry\Model\CountriesComponent;
use Zrcms\ContentLanguage\Model\LanguagesComponent;
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
     * @param FindBasicComponent $findBasicComponent
     */
    public function __construct(
        FindBasicComponent $findBasicComponent
    ) {
        $this->findBasicComponent = $findBasicComponent;
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
            $siteCmsResource,
            $country,
            $language
        );
    }
}
