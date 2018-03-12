<?php

namespace ZrcmsRcmCompatibility\RcmAdapter;

use Psr\Container\ContainerInterface;
use Zrcms\Core\Api\Component\FindComponent;
use Zrcms\CoreCountry\Api\GetDefaultCountry;
use Zrcms\CoreLanguage\Api\GetDefaultLanguage;

/**
 * @deprecated
 * @author James Jervis - https://github.com/jerv13
 */
class RcmSiteFromZrcmsSiteCmsResourceFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return RcmSiteFromZrcmsSiteCmsResource
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke(
        ContainerInterface $serviceContainer
    ) {
        return new RcmSiteFromZrcmsSiteCmsResource(
            $serviceContainer->get(FindComponent::class),
            $serviceContainer->get(GetDefaultCountry::class),
            $serviceContainer->get(GetDefaultLanguage::class)
        );
    }
}
