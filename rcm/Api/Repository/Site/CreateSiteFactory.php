<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Site;

use Interop\Container\ContainerInterface;
use Zrcms\CoreSite\Api\CmsResource\UpsertSiteCmsResource;
use Zrcms\Locale\Api\LocaleFromCountryLanguage;
use ZrcmsRcmCompatibility\RcmAdapter\RcmSiteFromZrcmsSiteCmsResource;

/**
 * @deprecated BC ONLY
 */
class CreateSiteFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return CreateSite
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(ContainerInterface $serviceContainer)
    {
        return new CreateSite(
            $serviceContainer->get(LocaleFromCountryLanguage::class),
            $serviceContainer->get(UpsertSiteCmsResource::class),
            $serviceContainer->get(RcmSiteFromZrcmsSiteCmsResource::class)
        );
    }
}
