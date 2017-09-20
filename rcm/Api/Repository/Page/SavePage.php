<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Page;

use Doctrine\ORM\EntityManager;
use Rcm\Entity\Page;
use Rcm\Entity\Site;

/**
 * @todo CONVERT THIS TO ZRCMS ADAPTER
 * @deprecated BC ONLY
 */
class SavePage extends \Rcm\Api\Repository\Page\SavePage
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
        $this->entityManager = $entityManager;
    }

    /**
     * @param Site  $destinationSite
     * @param Page  $newPage
     * @param array $options
     *
     * @return Page
     */
    public function __invoke(
        Site $destinationSite,
        Page $newPage,
        array $options = []
    ) {
        $newPage->setSite($destinationSite);

        $this->entityManager->persist($newPage);
        $destinationSite->addPage($newPage);
        $this->entityManager->flush($newPage);

        return $newPage;
    }
}
