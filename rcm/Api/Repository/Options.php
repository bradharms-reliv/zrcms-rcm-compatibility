<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository;

/**
 * @todo CONVERT THIS TO ZRCMS ADAPTER
 * @deprecated BC ONLY
 */
class Options extends \Rcm\Api\Repository\Options
{
    /**
     * @param array $options
     * @param       $key
     * @param null  $default
     *
     * @return mixed|null
     */
    public static function get(
        array $options,
        $key,
        $default = null
    ) {
        return (array_key_exists($key, $options) ? $options[$key] : $default);
    }
}
