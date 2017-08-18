<?php

namespace ZrcmsRcmCompatibility;
/**
 * @author James Jervis - https://github.com/jerv13
 */
class ModulesConfig
{
    /**
     * __invoke
     *
     * @return array
     */
    public function __invoke()
    {
        $zrcmsModules = [
            // Low level
            new \ZrcmsRcmCompatibility\Rcm\ModuleConfig(),
            //new \ZrcmsRcmCompatibility\RcmDisabler\ModuleConfig(),
        ];

        $configManager = new \Zend\ConfigAggregator\ConfigAggregator(
            $zrcmsModules
        );

        return $configManager->getMergedConfig();
    }
}
