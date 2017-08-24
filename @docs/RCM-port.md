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
LocaleBuilderCountryIso2Code
LocaleBuilderCountryIso3Code
LocaleBuilderLanguageIso6391Code
LocaleBuilderLocale
LocaleBuilderSite
WhereBuilderCountryIso2Code
WhereBuilderCountryIso3Code
WhereBuilderLanguageIso6391Code
WhereBuilderLocale
CartStatusModel
ProductModel
FixProductPageRows
SiteRcmBasicHydrator
ApiCallToActionController
PwsDomainController
BaseSiteService
PwsService
RcmApi\Page\Middleware\PageController
RcmExport\Api\Export
InventorySyncService
VistaCountryCodeService
RcmI18n\Factory\ModelRcmSiteLocalesFactory
RcmRedirectEditor\ApiController\RedirectController

rcm-admin -bunches

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
