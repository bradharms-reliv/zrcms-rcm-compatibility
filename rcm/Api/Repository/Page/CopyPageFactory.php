<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Page;

use Interop\Container\ContainerInterface;
use Zrcms\CorePage\Api\CmsResource\FindPageCmsResource;
use Zrcms\CorePage\Api\CmsResource\UpsertPageCmsResource;
use Zrcms\CorePage\Api\Content\InsertPageVersion;
use Zrcms\CoreSite\Api\CmsResource\FindSiteCmsResource;
use ZrcmsRcmCompatibility\RcmAdapter\RcmPageFromZrcmsPageCmsResource;

/**
 * @deprecated BC ONLY
 */
class CopyPageFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return CopyPage
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $serviceContainer)
    {
        return new CopyPage(
            $serviceContainer->get(FindSiteCmsResource::class),
            $serviceContainer->get(FindPageCmsResource::class),
            $serviceContainer->get(InsertPageVersion::class),
            $serviceContainer->get(UpsertPageCmsResource::class),
            $serviceContainer->get(RcmPageFromZrcmsPageCmsResource::class)
        );
    }
}
