<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Country;

use Interop\Container\ContainerInterface;
use Zrcms\Content\Api\Component\FindComponent;

/**
 * @deprecated BC ONLY
 */
class FindCountryByIso2Factory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return FindCountryByIso2
     */
    public function __invoke($serviceContainer)
    {
        return new FindCountryByIso2(
            $serviceContainer->get(FindComponent::class)
        );
    }
}
