RCM Port
========

- Cannot override ZF2 services because the config merge
- Create common service BC layer
    -x Current Request
    -x CurrentSite
    
- EventManger and events ported to Middleware
    - Logout
    - issue with RcmUser\Acl\Service\AuthorizeService (416) $this->getEventManager()->trigger(
    
- Need GetViewLayoutTags (port or wrap from ZF view helpers):
    - rcmGoogleAnalytics
    - browser-warning.html
    - rcmAdminPanel
    - rcmHtmlEditorOptions
    - basePath?
