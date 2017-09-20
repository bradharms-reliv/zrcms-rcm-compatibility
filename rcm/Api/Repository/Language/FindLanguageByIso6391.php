<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Language;

use Doctrine\ORM\EntityManager;
use Rcm\Entity\Language;

/**
 * @todo CONVERT THIS TO ZRCMS ADAPTER
 * @deprecated BC ONLY
 */
class FindLanguageByIso6391 extends \Rcm\Api\Repository\Language\FindLanguageByIso6391
{
    /**
     * @var \Rcm\Repository\Language
     */
    protected $repository;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(
        EntityManager $entityManager
    ) {
        $this->repository = $entityManager->getRepository(
            Language::class
        );
    }

    /**
     * @param string $iso639_1
     * @param array  $options
     *
     * @return null|Language
     */
    public function __invoke(
        string $iso639_1,
        array $options = []
    ) {
        return $this->repository->findOneBy(['iso639_1' => $iso639_1]);
    }
}
