<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Page;

use Doctrine\ORM\EntityManager;
use Rcm\Entity\Page;

/**
 * @todo CONVERT THIS TO ZRCMS ADAPTER
 * @deprecated BC ONLY
 */
class FindPageById
{
    /**
     * @var \Rcm\Repository\Page
     */
    protected $repository;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(
        EntityManager $entityManager
    ) {
        $this->repository = $entityManager->getRepository(
            Page::class
        );
    }

    /**
     * @param int   $id
     * @param array $options
     *
     * @return null|Page
     */
    public function __invoke(
        $id,
        array $options = []
    ) {
        return $this->repository->find($id);
    }
}
