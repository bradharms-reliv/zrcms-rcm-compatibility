<?php

namespace ZrcmsRcmCompatibility\Rcm\Factory;

use Psr\Container\ContainerInterface;
use ZrcmsRcmCompatibility\Rcm\Acl\CmsPermissionChecks;

/**
 * @deprecated BC ONLY
 * @author     James Jervis - https://github.com/jerv13
 */
class CmsPermissionsChecksFactory extends \Rcm\Factory\CmsPermissionsChecksFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return CmsPermissionChecks
     */
    public function __invoke(
        $serviceContainer
    ) {
        return parent::__invoke($serviceContainer);
    }
}
