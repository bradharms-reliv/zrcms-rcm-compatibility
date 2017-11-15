<?php

namespace ZrcmsRcmCompatibility\RcmAdapter;

use Psr\Container\ContainerInterface;
use Zrcms\ContentCore\Site\Api\Repository\FindSiteCmsResource;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class RcmPageFromZrcmsPageCmsResourceFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return RcmPageFromZrcmsPageCmsResource
     */
    public function __invoke(
        $serviceContainer
    ) {
        return new RcmPageFromZrcmsPageCmsResource(
            $serviceContainer->get(FindSiteCmsResource::class),
            $serviceContainer->get(RcmSiteFromZrcmsSiteCmsResource::class)
        );
    }
}
