<?php

namespace ZrcmsRcmCompatibility\Rcm\Adapter;

use Psr\Container\ContainerInterface;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class RcmSiteFromRequestFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return RcmSiteFromRequest
     */
    public function __invoke(
        $serviceContainer
    ) {
        return new RcmSiteFromRequest(
            $serviceContainer->get(RcmSiteFromHost::class)
        );
    }
}
