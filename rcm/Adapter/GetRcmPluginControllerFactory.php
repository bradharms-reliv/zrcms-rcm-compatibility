<?php

namespace ZrcmsRcmCompatibility\Rcm\Adapter;

use Psr\Container\ContainerInterface;

/**
 * @deprecated BC ONLY
 * @author James Jervis - https://github.com/jerv13
 */
class GetRcmPluginControllerFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return GetRcmPluginController
     */
    public function __invoke(
        $serviceContainer
    ) {
        return new GetRcmPluginController(
            $serviceContainer
        );
    }
}
