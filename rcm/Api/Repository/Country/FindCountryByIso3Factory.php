<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Country;

use Interop\Container\ContainerInterface;
use Zrcms\Content\Api\Component\FindComponent;
use Zrcms\ContentCore\Basic\Api\Component\FindBasicComponent;

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
            $serviceContainer->get(FindComponent::class)
        );
    }
}
