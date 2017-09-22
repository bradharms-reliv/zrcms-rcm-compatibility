<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Page;

use Interop\Container\ContainerInterface;
use Zrcms\ContentCore\Page\Api\Repository\FindPageContainerCmsResourceBySitePath;
use Zrcms\ContentCore\Page\Api\Repository\FindPageTemplateCmsResourceBySitePath;
use ZrcmsRcmCompatibility\RcmAdapter\RcmPageFromZrcmsPageContainerCmsResource;

/**
 * @deprecated BC ONLY
 */
class FindPageFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return FindPage
     */
    public function __invoke($serviceContainer)
    {
        return new FindPage(
            $serviceContainer->get(FindPageContainerCmsResourceBySitePath::class),
            $serviceContainer->get(FindPageTemplateCmsResourceBySitePath::class),
            $serviceContainer->get(RcmPageFromZrcmsPageContainerCmsResource::class)
        );
    }
}
