<?php

namespace ZrcmsRcmCompatibility\RcmAdapter;

use Zrcms\ContentCore\Site\Api\CmsResource\FindSiteCmsResourceByHost;
use ZrcmsRcmCompatibility\Rcm\Entity\Site;

/**
 * @deprecated BC ONLY
 * @author     James Jervis - https://github.com/jerv13
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
