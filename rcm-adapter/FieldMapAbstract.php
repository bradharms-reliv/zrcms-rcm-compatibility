<?php

namespace ZrcmsRcmCompatibility\RcmAdapter;

use Reliv\Json\Json;

/**
 * @deprecated BC ONLY
 * @author     James Jervis - https://github.com/jerv13
 */
abstract class FieldMapAbstract
{
    /**
     * @var array ['rcmField' => zrcmsField]
     */
    protected $fieldMap = [];

    /**
     * @param array $fieldMap
     */
    public function __construct(
        array $fieldMap
    ) {
        $this->fieldMap = $fieldMap;
    }

    /**
     * @param $rcmFieldValues
     *
     * @return array|null $zrcmsField
     * @throws \Exception
     */
    public function __invoke(
        $rcmFieldValues
    ) {
        // Avoids having to deal with this in the using service
        if (!is_array($rcmFieldValues)) {
            return $rcmFieldValues;
        }

        $zrcmsFieldValues = [];
        foreach ($rcmFieldValues as $rcmField => $value) {
            if (!array_key_exists($rcmField, $this->fieldMap)) {
                throw new \Exception(
                    'RCM field: (' . $rcmField . ') has not been mapped for field' . Json::encode($rcmField)
                );
            }

            $zrcmsFieldValues[$this->fieldMap[$rcmField]] = $value;
        }

        return $zrcmsFieldValues;
    }
}
