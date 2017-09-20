<?php

namespace ZrcmsRcmCompatibility\Api\Repository\Country;

use Doctrine\ORM\EntityManager;
use Rcm\Entity\Country;
use Zrcms\ContentCore\Basic\Api\Repository\FindBasicComponent;
use Zrcms\ContentCountry\Model\CountriesComponent;

/**
 * @deprecated BC ONLY
 */
class FindCountryByIso3
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
        $countriesComponent = $this->findBasicComponent->__invoke(
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
