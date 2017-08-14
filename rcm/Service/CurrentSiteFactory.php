<?php

namespace ZrcmsRcmCompatibility\Rcm\Service;

use Zend\Diactoros\ServerRequestFactory;
use Zrcms\ContentCore\Basic\Api\Repository\FindBasicComponent;
use Zrcms\ContentCore\Site\Model\PropertiesSiteVersion;
use Zrcms\ContentCore\View\Api\Repository\FindViewByRequest;
use Zrcms\ContentCountry\Api\Repository\FindCountryCmsResourceByIso3;
use Zrcms\ContentCountry\Api\Repository\FindCountryVersion;
use Zrcms\ContentCountry\Model\CountriesComponent;
use Zrcms\ContentLanguage\Model\LanguagesComponent;
use ZrcmsRcmCompatibility\Rcm\Entity\Country;
use ZrcmsRcmCompatibility\Rcm\Entity\Language;
use ZrcmsRcmCompatibility\Rcm\Entity\Site;

/**
 * @deprecated BC ONLY
 * @author     James Jervis - https://github.com/jerv13
 */
class CurrentSiteFactory
{
    /**
     * @param \Psr\Container\ContainerInterface $serviceContainer
     *
     * @return Site
     */
    public function __invoke(
        $serviceContainer
    ) {
        $request = ServerRequestFactory::fromGlobals();

        /** @var FindViewByRequest $findViewByRequest */
        $findViewByRequest = $serviceContainer->get(FindViewByRequest::class);

        /** @var FindBasicComponent $findBasicComponent */
        $findBasicComponent = $serviceContainer->get(FindBasicComponent::class);

        $view = $findViewByRequest->__invoke(
            $request
        );

        $zrSiteResource = $view->getSiteCmsResource();
        $zrSiteVersion = $view->getSite();

        $countryIso3 = $zrSiteVersion->getProperty(
            PropertiesSiteVersion::COUNTRY_ISO3
        );

        /** @var CountriesComponent $countriesComponent */
        $countriesComponent = $findBasicComponent->__invoke(
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
        $languagesComponent = $findBasicComponent->__invoke(
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
