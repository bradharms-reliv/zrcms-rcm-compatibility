<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Site;

use Interop\Container\ContainerInterface;
use Zrcms\ContentCore\Site\Api\CmsResource\UpsertSiteCmsResource;
use Zrcms\ContentCore\Site\Api\Repository\FindSiteCmsResource;

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
    public function __invoke($serviceContainer)
    {
        return new SetTheme(
            $serviceContainer->get(FindSiteCmsResource::class),
            $serviceContainer->get(UpsertSiteCmsResource::class)
        );
    }
}
