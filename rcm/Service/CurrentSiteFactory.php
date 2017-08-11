<?php

namespace ZrcmsRcmCompatibility\Rcm\Service;

use Zend\Diactoros\ServerRequestFactory;
use Zrcms\ContentCore\Site\Model\PropertiesSiteVersion;
use Zrcms\ContentCore\View\Api\Repository\FindViewByRequest;
use Zrcms\ContentCountry\Api\Repository\FindCountryCmsResourceByIso3;
use Zrcms\ContentCountry\Api\Repository\FindCountryVersion;
use Zrcms\ContentLanguage\Api\Repository\FindLanguageCmsResourceByIso6392t;
use Zrcms\ContentLanguage\Api\Repository\FindLanguageVersion;
use ZrcmsRcmCompatibility\Rcm\Entity\Country;
use ZrcmsRcmCompatibility\Rcm\Entity\Language;
use ZrcmsRcmCompatibility\Rcm\Entity\Site;

/**
 * @author James Jervis - https://github.com/jerv13
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

        /** @var FindCountryCmsResourceByIso3 $findCountryCmsResourceByIso3 */
        $findCountryCmsResourceByIso3 = $serviceContainer->get(FindCountryCmsResourceByIso3::class);

        /** @var FindCountryVersion $findCountryVersion */
        $findCountryVersion = $serviceContainer->get(FindCountryVersion::class);

        /** @var FindLanguageCmsResourceByIso6392t $findLanguageCmsResourceByIso6392t */
        $findLanguageCmsResourceByIso6392t = $serviceContainer->get(FindLanguageCmsResourceByIso6392t::class);

        /** @var FindLanguageVersion $findLanguageVersion */
        $findLanguageVersion = $serviceContainer->get(FindLanguageVersion::class);

        $view = $findViewByRequest->__invoke(
            $request
        );

        $zrSiteResource = $view->getSiteCmsResource();
        $zrSiteVersion = $view->getSite();

        $zrCountryResource = $findCountryCmsResourceByIso3->__invoke(
            $zrSiteVersion->getProperty(
                PropertiesSiteVersion::COUNTRY_ISO3
            )
        );

        $zrCountryVersion = $findCountryVersion->__invoke(
            $zrCountryResource->getContentVersionId()
        );

        $country = new Country(
            $zrCountryResource,
            $zrCountryVersion
        );

        $zrLanguageResource = $findLanguageCmsResourceByIso6392t->__invoke(
            $zrSiteVersion->getProperty(
                PropertiesSiteVersion::LANGUAGE_ISO_939_2T
            )
        );

        $zrLanguage = $findLanguageVersion->__invoke(
            $zrLanguageResource->getContentVersionId()
        );

        $language = new Language(
            $zrLanguageResource,
            $zrLanguage
        );

        return new Site(
            $zrSiteResource,
            $zrSiteVersion,
            $country,
            $language
        );
    }
}
