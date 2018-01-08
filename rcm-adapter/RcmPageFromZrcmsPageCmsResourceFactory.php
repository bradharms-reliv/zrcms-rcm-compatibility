<?php

namespace ZrcmsRcmCompatibility\RcmAdapter;

use Psr\Container\ContainerInterface;
use Zrcms\CoreSite\Api\CmsResource\FindSiteCmsResource;

/**
 * @deprecated BC ONLY
 * @author     James Jervis - https://github.com/jerv13
 */
class RcmPageFromZrcmsPageCmsResourceFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return RcmPageFromZrcmsPageCmsResource
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(
        ContainerInterface $serviceContainer
    ) {
        return new RcmPageFromZrcmsPageCmsResource(
            $serviceContainer->get(FindSiteCmsResource::class),
            $serviceContainer->get(RcmSiteFromZrcmsSiteCmsResource::class)
        );
    }
}
