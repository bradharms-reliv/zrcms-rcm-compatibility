<?php

namespace ZrcmsRcmCompatibility\Rcm\Acl;

use Psr\Container\ContainerInterface;

/**
 * @deprecated BC ONLY
 * @author James Jervis - https://github.com/jerv13
 */
class ResourceNameZrcmsFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return ResourceNameZrcms
     */
    public function __invoke(
        $serviceContainer
    ) {
        return new ResourceNameZrcms();
    }
}
