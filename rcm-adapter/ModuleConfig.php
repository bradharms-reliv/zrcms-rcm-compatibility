<?php

namespace ZrcmsRcmCompatibility\RcmAdapter;

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
        return [
            'dependencies' => [
                'factories' => [
                    /* Adapter ============================= */
                    CurrentRequest::class
                    => CurrentRequestFactory::class,

                    FieldMapSite::class
                    => FieldMapSiteFactory::class,

                    GetRcmConfig::class
                    => GetRcmConfigFactory::class,

                    GetRcmPluginController::class
                    => GetRcmPluginControllerFactory::class,

                    GetRcmViewRenderer::class
                    => GetRcmViewRendererFactory::class,

                    RcmPageFromZrcmsPageCmsResource::class
                    => RcmPageFromZrcmsPageCmsResourceFactory::class,

                    RcmPageRevisionsFromZrcmsPageCmsResourceHistoryList::class
                    => RcmPageRevisionsFromZrcmsPageCmsResourceHistoryListFactory::class,

                    RcmSiteFromHost::class
                    => RcmSiteFromHostFactory::class,

                    RcmSiteFromRequest::class
                    => RcmSiteFromRequestFactory::class,

                    RcmSiteFromZrcmsSiteCmsResource::class
                    => RcmSiteFromZrcmsSiteCmsResourceFactory::class
                ]
            ],
        ];
    }
}
