<?php

namespace ZrcmsRcmCompatibility\RcmAdapter;

use Interop\Container\ContainerInterface;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class RcmPageRevisionsFromZrcmsPageCmsResourceHistoryListFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return RcmPageRevisionsFromZrcmsPageCmsResourceHistoryList
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(
        ContainerInterface $serviceContainer
    ) {
        return new RcmPageRevisionsFromZrcmsPageCmsResourceHistoryList();
    }
}
