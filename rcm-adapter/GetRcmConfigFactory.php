<?php

namespace ZrcmsRcmCompatibility\RcmAdapter;

use Psr\Container\ContainerInterface;

/**
 * @deprecated BC ONLY
 * @author James Jervis - https://github.com/jerv13
 */
class GetRcmConfigFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return GetRcmConfig
     */
    public function __invoke(
        $serviceContainer
    ) {
        $config = $serviceContainer->get('Config');
        return new GetRcmConfig($config);
    }
}
