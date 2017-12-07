<?php

namespace ZrcmsRcmCompatibility\RcmAdapter;

use Psr\Container\ContainerInterface;
use Zrcms\Core\Api\Component\FindComponent;

/**
 * @deprecated
 * @author James Jervis - https://github.com/jerv13
 */
class RcmSiteFromZrcmsSiteCmsResourceFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return RcmSiteFromZrcmsSiteCmsResource
     */
    public function __invoke(
        $serviceContainer
    ) {
        return new RcmSiteFromZrcmsSiteCmsResource(
            $serviceContainer->get(FindComponent::class)
        );
    }
}
