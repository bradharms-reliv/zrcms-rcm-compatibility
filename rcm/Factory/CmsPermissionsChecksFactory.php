<?php

namespace ZrcmsRcmCompatibility\Rcm\Factory;

use Psr\Container\ContainerInterface;
use Rcm\Acl\ResourceName;
use ZrcmsRcmCompatibility\Rcm\Acl\CmsPermissionChecks;

/**
 * @deprecated BC ONLY
 * @author James Jervis - https://github.com/jerv13
 */
class CmsPermissionsChecksFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return CmsPermissionChecks
     */
    public function __invoke(
        $serviceContainer
    ) {
        /** @var \RcmUser\Service\RcmUserService $rcmUserService */
        $rcmUserService = $serviceContainer->get(\RcmUser\Service\RcmUserService::class);

        return new CmsPermissionChecks(
            $rcmUserService,
            $serviceContainer->get(ResourceName::class)
        );
    }
}
