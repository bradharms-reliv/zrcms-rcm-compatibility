RCM Port
========

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

- RCM page-types from RCM
    - How to handle page types = product pages

- RCM User needs PSR7 request interface
    - Get user from request
    - IsAllowed from request PHP API 
    -
