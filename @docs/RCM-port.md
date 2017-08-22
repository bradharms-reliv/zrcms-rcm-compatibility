RCM Port
========

- Add Expressive ModuleConfigs to each RCM module and prepare for 
  FORK (xxx-static (JS and CSS) xxx (server))
  
    - action-button 1.2.0
    - admin 1.21.0 FORK to new ZRCMS module
        - Port controllers and routes (adapter to new APIs)
        - deal with form elements?
        - Deal with includeFileManager?
        - Deal with navigation (new navigation GetViewLayoutTags)
        - Deal with event (always middleware?) (new rcmAdminPanel GetViewLayoutTags)
    - call-to-action-box 1.2.0
    - config 1.1.0
    - core-js 1.1.0
    - dynamic-navigation 1.21.0
        - Port to zrcms
        - PluginController need to be ported
        - 
    
    
    - html-area 1.2.0
    - html-purifier 1.2.0
    
    
    
    "phpunit/phpunit": "5.*",
    "squizlabs/php_codesniffer": "3.*"
        
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
