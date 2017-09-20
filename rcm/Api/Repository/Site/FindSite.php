<?php

namespace ZrcmsRcmCompatibility\Api\Repository\Site;

use Doctrine\ORM\EntityManager;
use Rcm\Entity\Site;

/**
 * @deprecated BC ONLY
 */
class FindSite
{
    /**
     * @var \Rcm\Repository\Site
     */
    protected $repository;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(
        EntityManager $entityManager
    ) {
        $this->repository = $entityManager->getRepository(
            Site::class
        );
    }

    /**
     * @param int   $id
     * @param array $options
     *
     * @return null|Site
     */
    public function __invoke(
        int $id,
        array $options = []
    ) {
        return $this->repository->find($id);
    }
}
