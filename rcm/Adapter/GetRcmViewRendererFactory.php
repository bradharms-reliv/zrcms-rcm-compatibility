<?php

namespace ZrcmsRcmCompatibility\Rcm\Adapter;

use Psr\Container\ContainerInterface;

/**
 * @deprecated BC ONLY
 * @author James Jervis - https://github.com/jerv13
 */
class GetRcmViewRendererFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return GetRcmViewRenderer
     */
    public function __invoke(
        $serviceContainer
    ) {
        return new GetRcmViewRenderer(
            $serviceContainer
        );
    }
}
