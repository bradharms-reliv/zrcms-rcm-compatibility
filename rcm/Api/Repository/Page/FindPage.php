<?php

namespace ZrcmsRcmCompatibility\Api\Repository\Page;

use Doctrine\ORM\EntityManager;
use Rcm\Entity\Page;
use Rcm\Page\PageTypes\PageTypes;

/**
 * @deprecated BC ONLY
 */
class FindPage
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
     * @param int    $siteId
     * @param string $pageName
     * @param string $pageType
     * @param array  $options
     *
     * @return null|Page
     */
    public function __invoke(
        int $siteId,
        string $pageName,
        string $pageType = PageTypes::NORMAL,
        array $options = []
    ) {
        return $this->repository->findOneBy(
            [
                'siteId' => $siteId,
                'name' => $pageName,
                'pageType' => $pageType
            ]
        );
    }
}
