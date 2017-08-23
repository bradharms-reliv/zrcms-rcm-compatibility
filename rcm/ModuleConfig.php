<?php

namespace ZrcmsRcmCompatibility\Rcm;

use Doctrine\Common\Util\Debug;
use Rcm\Module;
use ZrcmsRcmCompatibility\Rcm\Acl\ResourceNameZrcmsFactory;
use ZrcmsRcmCompatibility\Rcm\Adapter\CurrentRequest;
use ZrcmsRcmCompatibility\Rcm\Adapter\CurrentRequestFactory;
use ZrcmsRcmCompatibility\Rcm\Adapter\GetRcmConfig;
use ZrcmsRcmCompatibility\Rcm\Adapter\GetRcmConfigFactory;
use ZrcmsRcmCompatibility\Rcm\Adapter\GetRcmPluginController;
use ZrcmsRcmCompatibility\Rcm\Adapter\GetRcmPluginControllerFactory;
use ZrcmsRcmCompatibility\Rcm\Adapter\GetRcmViewRenderer;
use ZrcmsRcmCompatibility\Rcm\Adapter\GetRcmViewRendererFactory;
use ZrcmsRcmCompatibility\Rcm\Adapter\RcmSiteFromHost;
use ZrcmsRcmCompatibility\Rcm\Adapter\RcmSiteFromHostFactory;
use ZrcmsRcmCompatibility\Rcm\Adapter\RcmSiteFromRequest;
use ZrcmsRcmCompatibility\Rcm\Adapter\RcmSiteFromRequestFactory;
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

                /* Adapter ============================= */
                CurrentRequest::class
                => CurrentRequestFactory::class,

                GetRcmConfig::class
                => GetRcmConfigFactory::class,

                GetRcmPluginController::class
                => GetRcmPluginControllerFactory::class,

                GetRcmViewRenderer::class
                => GetRcmViewRendererFactory::class,

                RcmSiteFromHost::class
                => RcmSiteFromHostFactory::class,

                RcmSiteFromRequest::class
                => RcmSiteFromRequestFactory::class,

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
