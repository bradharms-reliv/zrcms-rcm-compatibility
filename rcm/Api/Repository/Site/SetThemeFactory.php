<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Site;

use Interop\Container\ContainerInterface;
use Zrcms\CoreSite\Api\CmsResource\UpsertSiteCmsResource;
use Zrcms\CoreSite\Api\CmsResource\FindSiteCmsResource;

/**
 * @deprecated BC ONLY
 */
class SetThemeFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return SetTheme
     */
    public function __invoke(ContainerInterface $serviceContainer)
    {
        return new SetTheme(
            $serviceContainer->get(FindSiteCmsResource::class),
            $serviceContainer->get(UpsertSiteCmsResource::class)
        );
    }
}
