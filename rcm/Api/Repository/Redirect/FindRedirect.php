<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Redirect;

use Doctrine\ORM\EntityManager;
use Rcm\Entity\Redirect;

/**
 * @todo CONVERT THIS TO ZRCMS ADAPTER
 * @deprecated BC ONLY
 */
class FindRedirect extends \Rcm\Api\Repository\Redirect\FindRedirect
{
    /**
     * @var \Rcm\Repository\Redirect
     */
    protected $repository;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(
        EntityManager $entityManager
    ) {
        $this->repository = $entityManager->getRepository(
            Redirect::class
        );
    }

    /**
     * @param int   $id
     * @param array $options
     *
     * @return null|Redirect
     */
    public function __invoke(
        int $id,
        array $options = []
    ) {
        return $this->repository->find($id);
    }
}
