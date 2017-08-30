<?php

namespace ZrcmsRcmCompatibility\Rcm\Service;

use Rcm\Service\DomainService;
use ZrcmsRcmCompatibility\RcmAdapter\RcmSiteFromHost;

/**
 * @deprecated BC ONLY
 * @author James Jervis - https://github.com/jerv13
 */
class SiteServiceFactory
{
    /**
     * @param \Psr\Container\ContainerInterface $serviceContainer
     *
     * @return SiteService
     */
    public function __invoke(
        $serviceContainer
    ) {
        return new SiteService(
            $serviceContainer->get(DomainService::class),
            $serviceContainer->get(RcmSiteFromHost::class)
        );
    }
}
