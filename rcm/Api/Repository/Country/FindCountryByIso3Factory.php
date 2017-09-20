<?php

namespace ZrcmsRcmCompatibility\Api\Repository\Country;

use Interop\Container\ContainerInterface;
use Zrcms\ContentCore\Basic\Api\Repository\FindBasicComponent;

/**
 * @deprecated BC ONLY
 */
class FindCountryByIso3Factory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return FindCountryByIso3
     */
    public function __invoke($serviceContainer)
    {
        return new FindCountryByIso3(
            $serviceContainer->get(FindBasicComponent::class)
        );
    }
}
