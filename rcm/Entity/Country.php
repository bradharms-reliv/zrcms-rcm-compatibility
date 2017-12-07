<?php

namespace ZrcmsRcmCompatibility\Rcm\Entity;

/**
 * @deprecated BC ONLY
 * @author     James Jervis - https://github.com/jerv13
 */
class Country extends \Rcm\Entity\Country
{
    public function __construct(
        \Zrcms\CoreCountry\Model\Country $country,
        string $createdByUserId,
        string $createdReason
    ) {
        $this->setCountryName(
            $country->getName()
        );

        $this->setIso2(
            $country->getIso2()
        );

        $this->setIso3(
            $country->getIso3()
        );

        parent::__construct($createdByUserId, $createdReason);
    }
}
