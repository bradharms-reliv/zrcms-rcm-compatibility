<?php

namespace ZrcmsRcmCompatibility\Rcm\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Zrcms\CoreSite\Model\SiteCmsResource;

/**
 * @deprecated BC ONLY
 * @author James Jervis - https://github.com/jerv13
 */
class Domain extends \Rcm\Entity\Domain
{
    /**
     * @param SiteCmsResource $siteCmsResource
     * @param Site            $site
     *
     * @throws \Zrcms\Core\Exception\TrackingInvalid
     */
    public function __construct(
        SiteCmsResource $siteCmsResource,
        Site $site
    ) {
        $siteVersion = $siteCmsResource->getContentVersion();

        $this->domainId = $siteCmsResource->getId();

        $this->domain = $siteCmsResource->getHost();

        $this->site = $site;

        // not supported in ZRCMS
        $this->primaryDomain = null;
        $this->primaryId = null;
        $this->additionalDomains = new ArrayCollection();

        $this->createdDate = $siteVersion->getCreatedDateObject();

        $this->createdByUserId = $siteVersion->getCreatedByUserId();

        $this->createdReason = $siteVersion->getCreatedReason();

        $this->modifiedDate = $siteVersion->getCreatedDateObject();

        $this->modifiedByUserId = $siteVersion->getCreatedByUserId();

        $this->modifiedReason = $siteVersion->getCreatedReason();
    }
}
