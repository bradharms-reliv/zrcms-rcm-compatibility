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
     * @param FindSiteCmsResourceByHost       $findSiteCmsResourceByHost
     * @param RcmSiteFromZrcmsSiteCmsResource $rcmSiteFromZrcmsSiteCmsResource
     */
    public function __construct(
        FindSiteCmsResourceByHost $findSiteCmsResourceByHost,
        RcmSiteFromZrcmsSiteCmsResource $rcmSiteFromZrcmsSiteCmsResource
    ) {
        $this->findSiteCmsResourceByHost = $findSiteCmsResourceByHost;
        $this->rcmSiteFromZrcmsSiteCmsResource = $rcmSiteFromZrcmsSiteCmsResource;
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
        $siteCmsResource = $this->findSiteCmsResourceByHost->__invoke(
            $host
        );

        return $this->rcmSiteFromZrcmsSiteCmsResource->__invoke($siteCmsResource);
    }
}
