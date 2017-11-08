<?php

namespace ZrcmsRcmCompatibility\RcmAdapter;

/**
 * @deprecated BC ONLY
 * @author James Jervis - https://github.com/jerv13
 */
class FieldMapSite extends FieldMapAbstract implements FieldMap
{
    public function __construct()
    {
        $fieldMap = [
            'siteId' => 'id'
        ];

        parent::__construct($fieldMap);
    }
}
