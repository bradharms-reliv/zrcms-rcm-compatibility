<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Page;

use Interop\Container\ContainerInterface;
use Zrcms\CorePage\Api\CmsResource\FindPageCmsResource;
use ZrcmsRcmCompatibility\RcmAdapter\RcmPageFromZrcmsPageCmsResource;

/**
 * @deprecated BC ONLY
 */
class FindPageByIdFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return FindPageById
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $serviceContainer)
    {
        return new FindPageById(
            $serviceContainer->get(FindPageCmsResource::class),
            $serviceContainer->get(RcmPageFromZrcmsPageCmsResource::class)
        );
    }
}
