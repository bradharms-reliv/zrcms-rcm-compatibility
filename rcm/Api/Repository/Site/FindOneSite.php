<?php

namespace ZrcmsRcmCompatibility\Rcm\Api\Repository\Site;

use Rcm\Entity\Site;
use Zrcms\CoreSite\Api\CmsResource\FindSiteCmsResourcesBy;
use ZrcmsRcmCompatibility\RcmAdapter\FieldMap;
use ZrcmsRcmCompatibility\RcmAdapter\RcmSiteFromZrcmsSiteCmsResource;

/**
 * @deprecated BC ONLY
 */
class FindOneSite extends \Rcm\Api\Repository\Site\FindOneSite
{
    protected $findSiteCmsResourceBy;
    protected $fieldMapSite;
    protected $rcmSiteFromZrcmsSiteCmsResource;

    /**
     * @param FindSiteCmsResourcesBy          $findSiteCmsResourceBy
     * @param FieldMap                        $fieldMapSite
     * @param RcmSiteFromZrcmsSiteCmsResource $rcmSiteFromZrcmsSiteCmsResource
     */
    public function __construct(
        FindSiteCmsResourcesBy $findSiteCmsResourceBy,
        FieldMap $fieldMapSite,
        RcmSiteFromZrcmsSiteCmsResource $rcmSiteFromZrcmsSiteCmsResource
    ) {
        $this->findSiteCmsResourceBy = $findSiteCmsResourceBy;
        $this->fieldMapSite = $fieldMapSite;
        $this->rcmSiteFromZrcmsSiteCmsResource = $rcmSiteFromZrcmsSiteCmsResource;
    }

    /**
     * @param array $criteria
     * @param null  $orderBy
     * @param array $options
     *
     * @return null|Site
     */
    public function __invoke(
        array $criteria = [],
        $orderBy = null,
        array $options = []
    ) {
        $criteria = $this->fieldMapSite->__invoke(
            $criteria
        );

        $orderBy = $this->fieldMapSite->__invoke(
            $orderBy
        );

        $siteCmsResources = $this->findSiteCmsResourceBy->__invoke(
            $criteria,
            $orderBy
        );

        if (empty($siteCmsResources)) {
            return null;
        }

        $siteCmsResource = $siteCmsResources[0];

        return $this->rcmSiteFromZrcmsSiteCmsResource->__invoke(
            $siteCmsResource
        );
    }
}
