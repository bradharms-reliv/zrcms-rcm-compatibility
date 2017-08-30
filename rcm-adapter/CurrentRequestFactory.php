<?php

namespace ZrcmsRcmCompatibility\RcmAdapter;

use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\ServerRequest;
use Zend\Diactoros\ServerRequestFactory;

/**
 * @deprecated BC ONLY
 * @author     James Jervis - https://github.com/jerv13
 */
class CurrentRequestFactory
{
    /**
     * @param ContainerInterface $serviceContainer
     *
     * @return ServerRequestInterface|ServerRequest
     */
    public function __invoke(
        $serviceContainer
    ) {
        return ServerRequestFactory::fromGlobals();
    }
}
