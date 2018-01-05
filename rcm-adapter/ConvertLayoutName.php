<?php

namespace ZrcmsRcmCompatibility\RcmAdapter;

use Zrcms\CoreTheme\Fields\FieldsThemeComponent;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class ConvertLayoutName
{
    /**
     * Use empty for default so it can fall back
     *
     * @param $rcmLayoutName
     *
     * @return string
     */
    public static function invoke(
        $rcmLayoutName
    ) {
        if ($rcmLayoutName == 'default') {
            return '';
        }

        return $rcmLayoutName;
    }
}
