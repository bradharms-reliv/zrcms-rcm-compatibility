<?php

namespace ZrcmsRcmCompatibility\Api\Repository\Setting;

use Doctrine\ORM\EntityManager;
use Rcm\Entity\Setting;

/**
 * @deprecated BC ONLY
 */
class FindSettingByName
{
    /**
     * @var \Doctrine\ORM\EntityRepository
     */
    protected $repository;

    /**
     * @param EntityManager $entityManager
     */
    public function __construct(
        EntityManager $entityManager
    ) {
        $this->repository = $entityManager->getRepository(
            Setting::class
        );
    }

    /**
     * @param string $name
     * @param array  $options
     *
     * @return null|object
     */
    public function __invoke(
        string $name,
        array $options = []
    ) {
        return $this->repository->findOneBy(['name' => $name]);
    }
}
