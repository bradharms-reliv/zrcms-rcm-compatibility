RCM Port
========

Milestones
----------

- Render main site with Rcm turned off
    - Redirects working
    - Product pages
- Render all site with Rcm turned off
    - Locales working
    - Redirects working
- Custom sites (PWS) with Rcm turned off
- Admin plugins
    - Edit and publish a page
    - Edit properties
- Misc admin stuff
    - ?????
- Migrate PROD
- Port/convert old modules to expressive
- Turn off ZF2 modules
- Turn off ZF2

@todo
-----

- Add Expressive ModuleConfigs to each RCM module and prepare for 
  FORK (xxx-static (JS and CSS) xxx (server))
  
    - action-button tagged-1.2.0
    - admin tagged-1.21.0 FORK to new ZRCMS module
- Port controllers and routes (adapter to new APIs)
- deal with form elements?
- Deal with includeFileManager?
- Deal with navigation (new navigation GetViewLayoutTags)
- Deal with event (always middleware?) (new rcmAdminPanel GetViewLayoutTags)
    - call-to-action-box tagged-1.2.0
    - config tagged-1.1.0
    - core-js tagged-1.1.0
    - dynamic-navigation tagged-1.21.0
- Port to zrcms
- PluginController need to be ported
- 
    - google-analytics tagged-1.21.0
- 3 controllers need to be ported
- View helper RcmGoogleAnalyticsJsHelper
    - google-search-box tagged-1.2.0
- View helpers
    - html-area tagged-1.2.0
    - html-purifier tagged-1.2.0
    - i18n (no change yet)
- Remove ZF2 config values from ModuleConfig
- View helpers
- Controllers and controller plugins
    - image-with-thumbnail tagged-1.1.0
    
    - PLUS MORE
    
- Remove direct usage of repositories
    - 
CountryRulesService 
    ---Country::findOneBy::iso3=FindCountryByIso3
LocaleBuilderCountryIso2Code
    ---Country::findOneBy::iso2=FindCountryByIso2
LocaleBuilderCountryIso3Code
    ---Country::findOneBy::iso3=FindCountryByIso3
LocaleBuilderLanguageIso6391Code
    ---Language::findOneBy::iso639_1=FindLanguageByIso639_1
LocaleBuilderLocale 
    ---Country::findOneBy::iso2=FindCountryByIso2
    ---Language::findOneBy::iso639_1=FindLanguageByIso639_1
LocaleBuilderSite
    ---Site::find::siteId=FindSite
WhereBuilderCountryIso2Code 
    ---Site::find::siteId=FindSite
    ---Country::findOneBy::iso2=FindCountryByIso2
WhereBuilderCountryIso3Code 
    ---Site::find::siteId=FindSite
    ---Country::findOneBy::iso2=FindCountryByIso2
WhereBuilderLanguageIso6391Code
    ---Site::find::siteId=FindSite
WhereBuilderLocale
    ---Site::find::siteId=FindSite
CartStatusModel
    ---Setting::findOneBy::name=FindSettingByName
ProductModel
    ---Page::findOneBy::[site, name, pageType]=FindPage
FixProductPageRows
    ---Site::findAll=FindAllSites
    ---Page::findBy::['pageType', 'site']=FindPagesByType
SiteRcmBasicHydrator
    --Site::find::siteId=FindSite
ApiCallToActionController
    --Site::find::siteId=FindSite
PwsDomainController
    --Domain::searchForDomain::$domainParts=FindDomainsLike
BaseSiteService
    --Domain::createDomain::[]=CreateSite // this will have to be create site=CopySite
    --Page::sitePageExists::[]=PageExists
    --Site::find::siteId=FindSite
    --RcmAdmin\Service\SiteManager::copySiteAndPopulate::[sourceSite, domain, siteData]=CopySite
PwsService
    --Site::find::siteId=FindSite
RcmApi\Page\Middleware\PageController
    --Page::sitePageExists::[]=PageExists
RcmExport\Api\Export
    --Site::findBy::[]=FindAllSites(with orderBy, limit)
    --Container::findBy::['site']=FindContainers(with orderBy, limit)
    --Page::findBy::['site']=FindPages(with orderBy, limit)
    --Redirect::findBy::[]=FindRedirects(with orderBy, limit)
InventorySyncService
    --Country::findOneBy::iso3=FindCountryByIso3
VistaCountryCodeService
    --Country::findOneBy::iso3=FindCountryByIso3
(lib)RcmI18n\Model\RcmSiteLocales RcmI18n\Factory\ModelRcmSiteLocalesFactory
    --Site::getSites::true=FindActiveSites
(lib)RcmRedirectEditor\ApiController\RedirectController
    --Redirect::find::id=FindRedirect
    --Redirect::save::Redirect=UpdateRedirect (change code)
    --Redirect::findBy::"null"=FindGlobalRedirects
    --Redirect::findBy::siteId=FindSiteRedirects
    --Site::find::siteId=FindSite

(lib)RCM ADMIN::::::::::::::::::::::::::::::::::::::::::
RcmAdmin\Service\SiteManager
    THIS SHOULD NOT BE NEEDED
RcmAdmin\Controller\ApiAdminCountryController
    Country::findBy::[[], ['countryName' => 'ASC']]
RcmAdmin\Controller\ApiAdminLanguageController
    Language::findBy[[], ['languageName' => 'ASC']]
RcmAdmin\Controller\ApiAdminManageSitesController
    Site::createQueryBuilder::"search for sites with domain like"
    Site::find::siteId
    Site::isValidSiteId::siteId
    Domain::createDomain::"createSite"
    siteManager::createSite
RcmAdmin\Controller\ApiAdminSitePageController
    Page::getSitePage::[site, pageId]
    Page::sitePageExists::[site, pageName, pageType]
    Page::updatePage::[page, data]
    Site::findOneBy::siteId (Site::find::siteId)
RcmAdmin\Controller\ApiAdminSitesCloneController
    Domain::createDomain::"createSite"
    siteManager::copySiteAndPopulate
    Site::find::siteId
RcmAdmin\Controller\PageViewPermissionsController
    Page::isValid::[site, pageName, pageType]
RcmAdmin\Factory\AdminNavigationFactory
    Page::findOneBy::[pageName, pageType]
    Page::getRevisionList::[]
RcmAdmin\Form\CreateTemplateFromPageForm RcmAdmin\Factory\CreateTemplateFromPageFormFactory
    pageRepo::"not used!"
RcmAdmin\Form\NewPageForm RcmAdmin\Form\NewPageFormFactory
    Page::getAllPageIdsAndNamesBySiteThenType::[siteId, pageType]
RcmAdmin\Controller\PageControllerRcmAdmin\Factory\PageControllerFactory
    Page::createPage::[site, pageData]
    Page::findOneBy::[pageId, pageType]
    Page::copyPage::[site, page, pageData]
RcmAdmin\Service\SiteManager
    Page::createPages::[site,settings, ...]
    Country::find::id
    Language::getLanguageByString::[code, format]
    Domain::getDomainByName::name
    Page::getPageByName::[site, name]
    PluginInstance::createPluginInstance
    PluginWrapper::savePluginWrapper
    
- Possible issue with sessions on BC layer
    
- Create common service BC layer
    -x Current Request
    -x CurrentSite
    
- EventManger and events ported to Middleware
    - Logout
    - issue with RcmUser\Acl\Service\AuthorizeService (416) $this->getEventManager()->trigger(
    
- Need GetViewLayoutTags (port or wrap from ZF view helpers):
    - rcmGoogleAnalytics
    -x browser-warning.html
    - rcmAdminPanel
    - rcmHtmlEditorOptions
    - basePath?
    - navigation (use old config for BC) tag name like 'zrcms-navigation.{menu-namespace}'
    - rcmDynamicLinksRenderLinks
    
- View Helpers to port:
    - rcmRichEdit
    - rcmTextEdit

- RCM page-types from RCM
    - How to handle page types = product pages

- RCM User needs PSR7 request interface
    - Get user from request
    - IsAllowed from request PHP API 
    -

- asset_manager
    -x Build PSR service like: AssetManager\Service\AssetManager
    -x Build ModuleConfig 
    -x Build middleware

- Cache break urls
