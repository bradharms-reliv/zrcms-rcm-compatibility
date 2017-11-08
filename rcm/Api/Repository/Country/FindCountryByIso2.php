<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Country;

use Zrcms\ContentCore\Basic\Api\Repository\FindBasicComponent;
use Zrcms\ContentCountry\Model\CountriesComponent;
use ZrcmsRcmCompatibility\Rcm\Entity\Country;

/**
 * @deprecated BC ONLY
 */
class FindCountryByIso2 extends \Rcm\Api\Repository\Country\FindCountryByIso2
{
    /**
     * @var FindBasicComponent
     */
    protected $findBasicComponent;

    /**
     * @param FindBasicComponent $findBasicComponent
     */
    public function __construct(
        FindBasicComponent $findBasicComponent
    ) {
        $this->findBasicComponent = $findBasicComponent;
    }

    /**
     * @param string $iso2
     * @param array  $options
     *
     * @return null|Country
     */
    public function __invoke(
        string $iso2,
        array $options = []
    ) {
        /** @var CountriesComponent $countriesComponent */
        $countriesComponent = $this->findBasicComponent->__invoke(
            'zrcms-countries'
        );

        $zrcmsCountries = $countriesComponent->getCountries();

        $zrcmsMatchCountry = null;

        foreach ($zrcmsCountries as $zrcmsCountry) {
            if ($zrcmsCountry->getIso2() === $iso2) {
                $zrcmsMatchCountry = $zrcmsCountry;
            }
        }

        if ($zrcmsMatchCountry === null) {
            return null;
        }

        return new Country(
            $zrcmsMatchCountry,
            $countriesComponent->getCreatedByUserId(),
            $countriesComponent->getCreatedReason()
        );
    }
}
