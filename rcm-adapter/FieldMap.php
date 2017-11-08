<?php

namespace ZrcmsRcmCompatibility\RcmAdapter;

/**
 * @deprecated BC ONLY
 * @author     James Jervis - https://github.com/jerv13
 */
interface FieldMap
{
    /**
     * @param array|null $rcmFieldValues ['{rcmField} => 'value']
     *
     * @return array|null $zrcmsField
     * @throws \Exception
     */
    public function __invoke(
        $rcmFieldValues
    );
}
