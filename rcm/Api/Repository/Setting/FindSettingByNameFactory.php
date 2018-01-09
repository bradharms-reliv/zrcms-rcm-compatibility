<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Setting;

use Interop\Container\ContainerInterface;

/**
 * @deprecated BC ONLY
 */
class FindSettingByNameFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return FindSettingByName
     */
    public function __invoke(ContainerInterface $serviceContainer)
    {
        return new FindSettingByName();
    }
}
