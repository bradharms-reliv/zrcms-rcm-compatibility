<?php

namespace ZrcmsRcmCompatibility\Rcm;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class Module
{
    /**
     * getConfig() is a requirement for all Modules in ZF2.  This
     * function is included as part of that standard.  See Docs on ZF2 for more
     * information.
     *
     * @return array Returns array to be used by the ZF2 Module Manager
     */
    public function getConfig()
    {

        $newConfigObject = new ModuleConfig();

        $newConfig = $newConfigObject->__invoke();

        $newConfig['service_manager'] = $newConfig['dependencies'];

        return $newConfig;
    }
}
