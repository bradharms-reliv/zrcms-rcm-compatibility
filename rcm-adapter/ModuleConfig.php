<?php

namespace ZrcmsRcmCompatibility\RcmAdapter;

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
        return [
            'dependencies' => [
                'factories' => [
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

                    RcmSiteFromZrcmsSiteCmsResource::class
                    => RcmSiteFromZrcmsSiteCmsResourceFactory::class
                ]
            ],
        ];
    }
}
