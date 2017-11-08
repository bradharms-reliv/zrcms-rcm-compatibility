<?php

namespace ZrcmsRcmCompatibility\RcmAdapter;

use Psr\Container\ContainerInterface;

/**
 * @deprecated BC ONLY
 * @author James Jervis - https://github.com/jerv13
 */
class FieldMapSiteFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return FieldMapSite
     */
    public function __invoke(
        $serviceContainer
    ) {
        return new FieldMapSite();
    }
}
