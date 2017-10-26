<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Page;

use Interop\Container\ContainerInterface;
use Zrcms\ContentCore\Page\Api\Repository\FindPageTemplateCmsResourcesBy;
use Zrcms\ContentCore\Page\Api\Repository\FindPageCmsResourcesBy;
use ZrcmsRcmCompatibility\RcmAdapter\RcmPageFromZrcmsPageCmsResource;

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
            $serviceContainer->get(FindPageCmsResourcesBy::class),
            $serviceContainer->get(FindPageTemplateCmsResourcesBy::class),
            $serviceContainer->get(RcmPageFromZrcmsPageCmsResource::class)
        );
    }
}
