<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Setting;

use Doctrine\ORM\EntityManager;
use Rcm\Entity\Setting;

/**
 * @todo CONVERT THIS TO ZRCMS ADAPTER
 * @deprecated BC ONLY
 */
class FindSettingByName extends \Rcm\Api\Repository\Setting\FindSettingByName
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
