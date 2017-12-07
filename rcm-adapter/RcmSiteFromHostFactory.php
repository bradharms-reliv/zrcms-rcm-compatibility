<?php

namespace ZrcmsRcmCompatibility\RcmAdapter;

use Psr\Container\ContainerInterface;
use Zrcms\CoreSite\Api\CmsResource\FindSiteCmsResourceByHost;

/**
 * @deprecated BC ONLY
 * @author     James Jervis - https://github.com/jerv13
 */
class RcmSiteFromHostFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return RcmSiteFromHost
     */
    public function __invoke(
        $serviceContainer
    ) {
        return new RcmSiteFromHost(
            $serviceContainer->get(FindSiteCmsResourceByHost::class),
            $serviceContainer->get(RcmSiteFromZrcmsSiteCmsResource::class)
        );
    }
}
