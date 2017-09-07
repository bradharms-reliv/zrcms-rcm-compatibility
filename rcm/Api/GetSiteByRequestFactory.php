<?php

namespace ZrcmsRcmCompatibility\Rcm\Api;

use Psr\Container\ContainerInterface;
use ZrcmsRcmCompatibility\RcmAdapter\RcmSiteFromHost;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class GetSiteByRequestFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return GetSiteByRequest
     */
    public function __invoke(
        $serviceContainer
    ) {
        return new GetSiteByRequest(
            $serviceContainer->get(RcmSiteFromHost::class)
        );
    }
}
