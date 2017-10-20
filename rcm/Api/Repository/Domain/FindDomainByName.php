<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Domain;

use Rcm\Entity\Domain;
use Zrcms\ContentCore\Site\Api\Repository\FindSiteCmsResourceByHost;
use ZrcmsRcmCompatibility\RcmAdapter\RcmSiteFromZrcmsSiteCmsResource;

/**
 * @deprecated BC ONLY
 */
class FindDomainByName extends \Rcm\Api\Repository\Domain\FindDomainByName
{
    protected $findSiteCmsResourceByHost;
    protected $rcmSiteFromZrcmsSiteCmsResource;

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
     * @param string $domainName
     * @param array  $options
     *
     * @return Domain|null
     */
    public function __invoke(
        string $domainName,
        array $options = []
    ) {
        $siteCmsResource = $this->findSiteCmsResourceByHost->__invoke(
            $domainName
        );

        if (empty($siteCmsResource)) {
            return null;
        }

        $site = $this->rcmSiteFromZrcmsSiteCmsResource->__invoke(
            $siteCmsResource
        );

        return new \ZrcmsRcmCompatibility\Rcm\Entity\Domain(
            $siteCmsResource,
            $site
        );
    }
}
