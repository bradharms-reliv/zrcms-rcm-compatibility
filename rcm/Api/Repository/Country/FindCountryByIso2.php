<?php

namespace ZrcmsRcmCompatibility\Api\Repository\Country;

use Doctrine\ORM\EntityManager;
use Rcm\Entity\Country;

/**
 * @deprecated BC ONLY
 */
class FindCountryByIso2
{
    /**
     * @var \Rcm\Repository\Country
     */
    protected $repository;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(
        EntityManager $entityManager
    ) {
        $this->repository = $entityManager->getRepository(
            Country::class
        );
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
        return $this->repository->findOneBy(['iso2' => $iso2]);
    }
}
