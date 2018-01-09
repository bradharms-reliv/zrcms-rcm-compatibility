<?php

namespace ZrcmsRcmCompatibility\Rcm\Api;

use Interop\Container\ContainerInterface;

/**
 * @deprecated BC ONLY
 * @author James Jervis - https://github.com/jerv13
 */
class GetSiteIdByRequestFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return GetSiteIdByRequest
     */
    public function __invoke(ContainerInterface $serviceContainer)
    {
        return new GetSiteIdByRequest(
            $serviceContainer->get(GetSiteByRequest::class)
        );
    }
}
