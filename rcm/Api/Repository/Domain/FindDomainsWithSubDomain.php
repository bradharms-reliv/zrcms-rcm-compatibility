<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Domain;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\NoResultException;
use Zrcms\CoreApplicationDoctrine\Api\BuildBasicCmsResource;
use Zrcms\CoreSite\Model\SiteCmsResource;
use Zrcms\CoreSite\Model\SiteCmsResourceBasic;
use Zrcms\CoreSite\Model\SiteVersionBasic;
use Zrcms\CoreSiteDoctrine\Entity\SiteCmsResourceEntity;
use Zrcms\CoreSiteDoctrine\Entity\SiteVersionEntity;
use ZrcmsRcmCompatibility\Rcm\Entity\Domain;
use ZrcmsRcmCompatibility\RcmAdapter\RcmSiteFromZrcmsSiteCmsResource;

/**
 * @todo This should NOT be using EntityManager directly, need abstraction layer in CoreSite
 * @deprecated BC ONLY
 */
class FindDomainsWithSubDomain extends \Rcm\Api\Repository\Domain\FindDomainsWithSubDomain
{
    protected $entityManager;
    protected $rcmSiteFromZrcmsSiteCmsResource;

    /**
     * @param EntityManager                   $entityManager
     * @param RcmSiteFromZrcmsSiteCmsResource $rcmSiteFromZrcmsSiteCmsResource
     */
    public function __construct(
        EntityManager $entityManager,
        RcmSiteFromZrcmsSiteCmsResource $rcmSiteFromZrcmsSiteCmsResource
    ) {
        $this->entityManager = $entityManager;
        $this->rcmSiteFromZrcmsSiteCmsResource = $rcmSiteFromZrcmsSiteCmsResource;
    }

    /**
     * @param string $domainPrefix
     * @param array  $options
     *
     * @return array
     * @throws \Exception
     * @throws \Zrcms\Core\Exception\TrackingInvalid
     */
    public function __invoke(
        string $domainPrefix,
        array $options = []
    ): array {
        /** @var \Doctrine\ORM\Query $query */
        $query = $this->entityManager->createQuery(
            'SELECT site ' .
            'FROM ' . SiteCmsResourceEntity::class . ' site ' .
            'WHERE site.host LIKE :domainPrefix ' .
            'OR site.host = :domain'
        );
        $query->setParameter('domainPrefix', $domainPrefix . '.%');
        $query->setParameter('domain', $domainPrefix);

        try {
            $siteCmsResourceEntities = $query->getResult();
        } catch (NoResultException $e) {
            $siteCmsResourceEntities =  [];
        }

        $results = [];

        /** @var SiteCmsResourceEntity $siteCmsResourceEntity */
        foreach ($siteCmsResourceEntities as $siteCmsResourceEntity) {
            /** @var SiteCmsResource $siteCmsResource */
            $siteCmsResource = BuildBasicCmsResource::invoke(
                SiteCmsResourceEntity::class,
                SiteCmsResourceBasic::class,
                SiteVersionEntity::class,
                SiteVersionBasic::class,
                $siteCmsResourceEntity
            );

            $results[] = new Domain(
                $siteCmsResource,
                $this->rcmSiteFromZrcmsSiteCmsResource->__invoke(
                    $siteCmsResource
                )
            );
        }

        return $results;
    }
}
