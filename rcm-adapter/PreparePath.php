<?php

namespace ZrcmsRcmCompatibility\RcmAdapter;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class PreparePath
{
    /**
     * @param string $pagePath
     *
     * @return string
     */
    public static function invoke(string $pagePath)
    {
        if (substr($pagePath, 0, 1) !== "/") {
            $pagePath = '/' . $pagePath;
        }

        return $pagePath;
    }
}
