<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Country;

use Zrcms\Content\Api\Component\FindComponent;
use Zrcms\ContentCountry\Model\CountriesComponent;
use ZrcmsRcmCompatibility\Rcm\Entity\Country;

/**
 * @deprecated BC ONLY
 */
class FindCountryByIso3 extends \Rcm\Api\Repository\Country\FindCountryByIso3
{
    /**
     * @var FindComponent
     */
    protected $findComponent;

    /**
     * @param FindComponent $findComponent
     */
    public function __construct(
        FindComponent $findComponent
    ) {
        $this->findComponent = $findComponent;
    }

    /**
     * @param string $iso3
     * @param array  $options
     *
     * @return null|Country
     */
    public function __invoke(
        string $iso3,
        array $options = []
    ) {
        /** @var CountriesComponent $countriesComponent */
        $countriesComponent = $this->findComponent->__invoke(
            'basic',
            'zrcms-countries'
        );

        $zrCountry = $countriesComponent->getCountry($iso3);

        return new Country(
            $zrCountry,
            $countriesComponent->getCreatedByUserId(),
            $countriesComponent->getCreatedReason()
        );
    }
}
