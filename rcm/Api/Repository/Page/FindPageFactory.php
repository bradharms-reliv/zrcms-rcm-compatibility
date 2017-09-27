<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Page;

use Interop\Container\ContainerInterface;
use Zrcms\ContentCore\Page\Api\Repository\FindPageTemplateCmsResourcesBy;
use Zrcms\ContentCore\Page\Api\Repository\FindPageContainerCmsResourcesBy;
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
            $serviceContainer->get(FindPageContainerCmsResourcesBy::class),
            $serviceContainer->get(FindPageTemplateCmsResourcesBy::class),
            $serviceContainer->get(RcmPageFromZrcmsPageContainerCmsResource::class)
        );
    }
}
