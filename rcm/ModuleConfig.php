<?php

namespace ZrcmsRcmCompatibility\Rcm;

use ZrcmsRcmCompatibility\Rcm\Adapter\CurrentRequest;
use ZrcmsRcmCompatibility\Rcm\Adapter\CurrentRequestFactory;
use ZrcmsRcmCompatibility\Rcm\Adapter\RcmSiteFromHost;
use ZrcmsRcmCompatibility\Rcm\Adapter\RcmSiteFromHostFactory;
use ZrcmsRcmCompatibility\Rcm\Adapter\RcmSiteFromRequest;
use ZrcmsRcmCompatibility\Rcm\Adapter\RcmSiteFromRequestFactory;
use ZrcmsRcmCompatibility\Rcm\Service\CurrentSiteFactory;
use ZrcmsRcmCompatibility\Rcm\Service\SiteServiceFactory;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class ModuleConfig
{
    /**
     * __invoke
     *
     * @return array
     */
    public function __invoke()
    {
        return [
            'dependencies' => [
                'factories' => [
                    CurrentRequest::class
                    => CurrentRequestFactory::class,

                    RcmSiteFromHost::class
                    => RcmSiteFromHostFactory::class,

                    RcmSiteFromRequest::class
                    => RcmSiteFromRequestFactory::class,

                    \Rcm\Service\CurrentSite::class
                    => CurrentSiteFactory::class,

                    \Rcm\Service\SiteService::class
                    => SiteServiceFactory::class,
                ],
            ],
        ];
    }
}
