<?php

namespace ZrcmsRcmCompatibility\Rcm\Api;

use Psr\Http\Message\ServerRequestInterface;
use ZrcmsRcmCompatibility\Rcm\Entity\Site;
use ZrcmsRcmCompatibility\RcmAdapter\RcmSiteFromHost;

/**
 * @author James Jervis - https://github.com/jerv13
 */
class GetSiteByRequest extends \Rcm\Api\GetSiteByRequest
{
    protected $rcmSiteFromHost;

    protected $cache = [];

    /**
     * @param RcmSiteFromHost $rcmSiteFromHost
     */
    public function __construct(RcmSiteFromHost $rcmSiteFromHost)
    {
        $this->rcmSiteFromHost = $rcmSiteFromHost;
    }

    /**
     * @param ServerRequestInterface $request
     * @param array                  $options
     *
     * @return Site|null
     */
    public function __invoke(
        ServerRequestInterface $request,
        array $options = []
    ) {
        $host = $request->getUri()->getHost();

        if (array_key_exists($host, $this->cache)) {
            return $this->cache[$host];
        }

        $this->cache[$host] = $this->rcmSiteFromHost->__invoke($host);

        return $this->cache[$host];
    }
}
