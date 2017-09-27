<?php

namespace ZrcmsRcmCompatibility\RcmAdapter;

use Psr\Container\ContainerInterface;
use Zrcms\ContentCore\Site\Api\Repository\FindSiteCmsResource;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class RcmPageFromZrcmsPageContainerCmsResourceFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return RcmPageFromZrcmsPageContainerCmsResource
     */
    public function __invoke(
        $serviceContainer
    ) {
        return new RcmPageFromZrcmsPageContainerCmsResource(
            $serviceContainer->get(FindSiteCmsResource::class),
            $serviceContainer->get(RcmSiteFromZrcmsSiteCmsResource::class)
        );
    }
}
