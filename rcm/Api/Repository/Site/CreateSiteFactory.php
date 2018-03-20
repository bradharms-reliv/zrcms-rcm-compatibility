<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Site;

use Interop\Container\ContainerInterface;
use Zrcms\CoreSite\Api\CmsResource\CreateSiteCmsResource;
use Zrcms\CoreSite\Api\Content\InsertSiteVersion;
use Zrcms\LocaleZrcms\Api\LocaleFromCountryLanguage;
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
            $serviceContainer->get(InsertSiteVersion::class),
            $serviceContainer->get(CreateSiteCmsResource::class),
            $serviceContainer->get(RcmSiteFromZrcmsSiteCmsResource::class)
        );
    }
}
