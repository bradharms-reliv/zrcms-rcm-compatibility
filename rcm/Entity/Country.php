<?php

namespace ZrcmsRcmCompatibility\Rcm\Entity;

use Zrcms\ContentCountry\Model\CountryCmsResource;
use Zrcms\ContentCountry\Model\CountryVersion;

/**
 * @deprecated BC ONLY
 * @author James Jervis - https://github.com/jerv13
 */
class Country extends \Rcm\Entity\Country
{
    public function __construct(
        CountryCmsResource $countryCmsResource,
        CountryVersion $countryVersion
    ) {
        $createdByUserId = $countryVersion->getCreatedByUserId();
        $createdReason = $countryVersion->getCreatedReason();

        $this->setCountryName(
            $countryVersion->getName()
        );

        $this->setIso2(
            $countryVersion->getIso2()
        );

        $this->setIso3(
            $countryVersion->getIso3()
        );

        parent::__construct($createdByUserId, $createdReason);
    }
}
