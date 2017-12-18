<?php

namespace ZrcmsRcmCompatibility\Rcm;

use Rcm\Api\Repository\Country\FindCountryByIso2;
use Rcm\Module;
use ZrcmsRcmCompatibility\Rcm\Acl\ResourceNameZrcmsFactory;
use ZrcmsRcmCompatibility\Rcm\Api\GetSiteByRequestFactory;
use ZrcmsRcmCompatibility\Rcm\Api\Repository\Country\FindCountryByIso2Factory;
use ZrcmsRcmCompatibility\Rcm\Api\Repository\Country\FindCountryByIso3Factory;
use ZrcmsRcmCompatibility\Rcm\Api\Repository\Domain\FindDomainByNameFactory;
use ZrcmsRcmCompatibility\Rcm\Api\Repository\Language\FindLanguageByIso6392tFactory;
use ZrcmsRcmCompatibility\Rcm\Api\Repository\Page\FindPageFactory;
use ZrcmsRcmCompatibility\Rcm\Api\Repository\Setting\FindSettingByNameFactory;
use ZrcmsRcmCompatibility\Rcm\Api\Repository\Site\FindOneSiteFactory;
use ZrcmsRcmCompatibility\Rcm\Api\Repository\Site\FindSiteFactory;
use ZrcmsRcmCompatibility\Rcm\Api\Repository\Site\SetThemeFactory;
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

                /* Api ============================= */
                \Rcm\Api\Repository\Country\FindCountryByIso2::class
                => FindCountryByIso2Factory::class,

                \Rcm\Api\Repository\Country\FindCountryByIso3::class
                => FindCountryByIso3Factory::class,

                \Rcm\Api\Repository\Domain\FindDomainByName::class
                => FindDomainByNameFactory::class,

                \Rcm\Api\Repository\Language\FindLanguageByIso6392t::class
                => FindLanguageByIso6392tFactory::class,

                \Rcm\Api\Repository\Page\FindPage::class
                => FindPageFactory::class,

                \Rcm\Api\Repository\Setting\FindSettingByName::class
                => FindSettingByNameFactory::class,

                \Rcm\Api\Repository\Site\FindOneSite::class
                => FindOneSiteFactory::class,

                \Rcm\Api\Repository\Site\FindSite::class
                => FindSiteFactory::class,

                \Rcm\Api\Repository\Site\SetTheme::class
                => SetThemeFactory::class,

                \Rcm\Api\GetSiteByRequest::class
                => GetSiteByRequestFactory::class,

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

        $viewManager = [
            'template_map' => [
                'layout/layout'
                => __DIR__ . '/../rcm-view/layout/none.phtml',
            ],
        ];

        return [
            'asset_manager' => $rcmConfig['asset_manager'],
            'dependencies' => $dependencies,
            // @todo THIS NEED TO BE KILLED
            'Rcm' => $rcmConfig['Rcm'],
            'rcmPlugin' => $rcmConfig['rcmPlugin'],
            'rcmCache' => $rcmConfig['rcmCache'],
            'RcmUser' => $rcmConfig['RcmUser'],
            'view_manager' => $viewManager,
        ];
    }
}
