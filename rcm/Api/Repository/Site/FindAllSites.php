<?php

namespace ZrcmsRcmCompatibility\Api\Repository\Site;

use Doctrine\ORM\EntityManager;
use Rcm\Entity\Site;
use Rcm\Api\Repository\Options;

/**
 * @deprecated BC ONLY
 */
class FindAllSites
{
    const OPTION_ORDER_BY = 'orderBy';
    const OPTION_LIMIT = 'limit';
    const OPTION_OFFSET = 'offset';
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
     * @param array $options
     *
     * @return Site[]
     */
    public function __invoke(
        array $options = []
    ) {
        $orderBy = Options::get($options, self::OPTION_ORDER_BY, null);
        $limit = Options::get($options, self::OPTION_LIMIT, null);
        $offset = Options::get($options, self::OPTION_OFFSET, null);

        return $this->repository->findBy([], $orderBy, $limit, $offset);
    }
}
