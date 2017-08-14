<?php

namespace ZrcmsRcmCompatibility\Rcm;

use ZrcmsRcmCompatibility\Rcm\Service\CurrentSiteFactory;

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
                    \Rcm\Service\CurrentSite::class => CurrentSiteFactory::class,
                ],
            ],
        ];
    }
}
