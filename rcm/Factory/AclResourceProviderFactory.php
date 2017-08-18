<?php

namespace ZrcmsRcmCompatibility\Rcm\Factory;

use Psr\Container\ContainerInterface;
use Rcm\Acl\ResourceName;
use Rcm\Service\CurrentSite;
use ZrcmsRcmCompatibility\Rcm\Acl\ResourceProvider;

/**
 * @deprecated BC ONLY
 * @author James Jervis - https://github.com/jerv13
 */
class AclResourceProviderFactory extends \Rcm\Factory\AclResourceProviderFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return ResourceProvider
     */
    public function __invoke(
        $serviceContainer
    ) {
        /** @var GetRcmConfig $getRcmConfig */
        $getRcmConfig = $serviceContainer->get(GetRcmConfig::class);
        $config = $getRcmConfig->__invoke();

        $aclConfig = [];

        if (!empty($config['Rcm']['Acl'])) {
            $aclConfig = $config['Rcm']['Acl'];
        }

        /** @var \Rcm\Entity\Site $currentSite */
        $currentSite = $serviceContainer->get(CurrentSite::class);
        /** @var ResourceName $resourceName */
        $resourceName = $serviceContainer->get(ResourceName::class);

        return new ResourceProvider(
            $aclConfig,
            $currentSite,
            $resourceName
        );
    }
}
