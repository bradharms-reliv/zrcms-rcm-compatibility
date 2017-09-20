<?php

namespace ZrcmsRcmCompatibility\Api\Repository\Domain;

use Doctrine\ORM\EntityManager;
use Rcm\Entity\Domain;

/**
 * @todo CONVERT THIS TO ZRCMS ADAPTER
 * @deprecated BC ONLY
 */
class FindDomainByName
{
    /**
     * @var \Rcm\Repository\Domain
     */
    protected $repository;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(
        EntityManager $entityManager
    ) {
        $this->repository = $entityManager->getRepository(
            Domain::class
        );
    }

    /**
     * @param string $domainName
     * @param array  $options
     *
     * @return Domain[]
     */
    public function __invoke(
        string $domainName,
        array $options = []
    ) {
        return $this->repository->findOneBy(
            ['domain' => $domainName]
        );
    }
}
