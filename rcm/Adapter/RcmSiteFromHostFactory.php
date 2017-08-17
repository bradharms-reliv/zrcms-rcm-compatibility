<?php

namespace ZrcmsRcmCompatibility\Rcm\Adapter;

use Psr\Container\ContainerInterface;
use Zrcms\ContentCore\Basic\Api\Repository\FindBasicComponent;
use Zrcms\ContentCore\Site\Api\Repository\FindSiteCmsResourceVersionByHost;

/**
 * @deprecated BC ONLY
 * @author James Jervis - https://github.com/jerv13
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
            $serviceContainer->get(FindSiteCmsResourceVersionByHost::class),
            $serviceContainer->get(FindBasicComponent::class)
        );
    }
}
