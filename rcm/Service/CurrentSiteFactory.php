<?php

namespace ZrcmsRcmCompatibility\Rcm\Service;

use Zend\Diactoros\ServerRequestFactory;
use ZrcmsRcmCompatibility\RcmAdapter\RcmSiteFromRequest;
use ZrcmsRcmCompatibility\Rcm\Entity\Site;

/**
 * @deprecated BC ONLY
 * @author     James Jervis - https://github.com/jerv13
 */
class CurrentSiteFactory
{
    /**
     * @param \Psr\Container\ContainerInterface $serviceContainer
     *
     * @return Site
     */
    public function __invoke(
        $serviceContainer
    ) {
        $request = ServerRequestFactory::fromGlobals();
        /** @var RcmSiteFromRequest $rcmSiteFromRequest */
        $rcmSiteFromRequest = $serviceContainer->get(RcmSiteFromRequest::class);

        return $rcmSiteFromRequest->__invoke(
            $request
        );
    }
}
