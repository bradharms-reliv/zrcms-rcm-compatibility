<?php

namespace ZrcmsRcmCompatibility\RcmAdapter;

use Rcm\Page\PageTypes\PageTypes;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class PreparePath
{
    /**
     * @param string $pagePath
     * @param string $pageType
     *
     * @return string
     */
    public static function invoke(string $pagePath, string $pageType = PageTypes::NORMAL)
    {
        if (substr($pagePath, 0, 1) !== "/") {
            $pagePath = '/' . $pagePath;
        }

        if ($pageType !== PageTypes::NORMAL && $pageType !== PageTypes::TEMPLATE) {
            $pagePath = '/' . $pageType . $pagePath;
        }

        return $pagePath;
    }
}
