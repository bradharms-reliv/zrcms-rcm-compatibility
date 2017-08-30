<?php

namespace ZrcmsRcmCompatibility\Rcm;

use Rcm\Module;
use ZrcmsRcmCompatibility\Rcm\Acl\ResourceNameZrcmsFactory;
use ZrcmsRcmCompatibility\Rcm\Factory\CmsPermissionsChecksFactory;
use ZrcmsRcmCompatibility\Rcm\Factory\SessionManagerFactory;
use ZrcmsRcmCompatibility\Rcm\Service\CurrentSiteFactory;
use ZrcmsRcmCompatibility\Rcm\Service\SiteServiceFactory;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class ModuleConfig
{
    /**
     * __invoke
     *
     * @return array
     */
    public function __invoke()
    {
        $rcmModule = new Module();
        $rcmConfig = $rcmModule->getConfig();

        $dependencies = [
            'factories' => [
                /* Acl ============================= */
                \Rcm\Acl\CmsPermissionChecks::class
                => CmsPermissionsChecksFactory::class,

                \Rcm\Acl\ResourceName::class
                => ResourceNameZrcmsFactory::class,

                /* Service ============================= */
                \Rcm\Service\CurrentSite::class
                => CurrentSiteFactory::class,

                \Rcm\Service\SessionManager::class
                => SessionManagerFactory::class,

                \Rcm\Service\SiteService::class
                => SiteServiceFactory::class,
            ]
        ];

        $dependencies = \Zend\Stdlib\ArrayUtils::merge(
            $rcmConfig['service_manager'],
            $dependencies
        );

        return [
            'asset_manager' => $rcmConfig['asset_manager'],
            'dependencies' => $dependencies,
            // @todo THIS NEED TO BE KILLED
            'Rcm' => $rcmConfig['Rcm'],
            'rcmPlugin' => $rcmConfig['rcmPlugin'],
            'rcmCache' => $rcmConfig['rcmCache'],
            'RcmUser' => $rcmConfig['RcmUser'],
        ];
    }
}
