<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Language;

use Interop\Container\ContainerInterface;
use Zrcms\ContentCore\Basic\Api\Component\FindBasicComponent;

/**
 * @deprecated BC ONLY
 */
class FindLanguageByIso6392tFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return FindLanguageByIso6392t
     */
    public function __invoke($serviceContainer)
    {
        return new FindLanguageByIso6392t(
            $serviceContainer->get(FindBasicComponent::class)
        );
    }
}
