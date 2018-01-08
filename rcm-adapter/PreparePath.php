<?php

namespace ZrcmsRcmCompatibility\RcmAdapter;

use Rcm\Page\PageTypes\PageTypes;

/**
 * @deprecated BC ONLY
 * @author     James Jervis - https://github.com/jerv13
 */
class PreparePath
{
    /**
     * @param string $rcmPagePath
     * @param string $rcmPageType
     *
     * @return string ZRCMS Path
     */
    public static function invoke(string $rcmPagePath, string $rcmPageType = PageTypes::NORMAL)
    {
        if ($rcmPagePath == 'index') {
            $rcmPagePath = '/';
        }

        if (substr($rcmPagePath, 0, 1) !== "/") {
            $rcmPagePath = '/' . $rcmPagePath;
        }

        if ($rcmPageType !== PageTypes::NORMAL && $rcmPageType !== PageTypes::TEMPLATE) {
            $rcmPagePath = '/' . $rcmPageType . $rcmPagePath;
        }

        return $rcmPagePath;
    }
}
