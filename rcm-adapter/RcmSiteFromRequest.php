<?php

namespace ZrcmsRcmCompatibility\RcmAdapter;

use Psr\Http\Message\ServerRequestInterface;

/**
 * @todo Use Rcm\Api\GetSiteByRequest
 * @deprecated BC ONLY
 * @author James Jervis - https://github.com/jerv13
 */
class RcmSiteFromRequest
{
    public function __construct(
        RcmSiteFromHost $rcmSiteFromHost
    ) {
        $this->rcmSiteFromHost = $rcmSiteFromHost;
    }

    /**
     * @param ServerRequestInterface $request
     * @param array                  $options
     *
     * @return \ZrcmsRcmCompatibility\Rcm\Entity\Site
     */
    public function __invoke(
        ServerRequestInterface $request,
        array $options = []
    ) {
        return $this->rcmSiteFromHost->__invoke(
            $request->getUri()->getHost()
        );
    }
}
