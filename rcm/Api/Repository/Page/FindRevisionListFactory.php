<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Page;

use Doctrine\ORM\EntityManager;
use Interop\Container\ContainerInterface;
use Zrcms\CorePage\Api\CmsResourceHistory\FindPageCmsResourceHistoryBy;
use ZrcmsRcmCompatibility\RcmAdapter\RcmPageRevisionsFromZrcmsPageCmsResourceHistoryList;

/**
 * @todo CONVERT THIS TO ZRCMS ADAPTER
 * @deprecated BC ONLY
 */
class FindRevisionListFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return FindRevisionList
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $serviceContainer)
    {
        return new FindRevisionList(
            $serviceContainer->get(FindPageCmsResourceHistoryBy::class),
            $serviceContainer->get(RcmPageRevisionsFromZrcmsPageCmsResourceHistoryList::class)
        );
    }
}
