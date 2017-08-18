<?php

namespace ZrcmsRcmCompatibility\Rcm\Adapter;

use Rcm\Module;

/**
 * @deprecated BC ONLY
 * @author     James Jervis - https://github.com/jerv13
 */
class GetRcmConfig
{
    protected $config;

    protected $mergeConfig = [];

    /**
     * @param array $config
     */
    public function __construct(
        $config
    ) {
        $this->config = $config;
    }

    /**
     * @return array
     */
    public function __invoke()
    {
        if (!empty($this->mergeConfig)) {
            return $this->mergeConfig;
        }
        $module = new Module();

        $rcmConfig = $module->getConfig();

        $this->mergeConfig = array_merge_recursive(
            $rcmConfig,
            $this->config
        );

        return $this->mergeConfig;
    }
}
