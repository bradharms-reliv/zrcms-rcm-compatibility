<?php

namespace ZrcmsRcmCompatibility\Rcm\Factory;

use Psr\Container\ContainerInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Session\Container;
use Zend\Session\SessionManager;
use ZrcmsRcmCompatibility\Rcm\Adapter\GetRcmConfig;

/**
 * @deprecated BC ONLY
 * @author James Jervis - https://github.com/jerv13
 */
class SessionManagerFactory extends \Rcm\Factory\SessionManagerFactory
{
    /**
     * @param ContainerInterface|ServiceLocatorInterface $serviceContainer
     *
     * @return SessionManager
     */
    public function __invoke(
        $serviceContainer
    ) {
        /** @var GetRcmConfig $getRcmConfig */
        $getRcmConfig = $serviceContainer->get(GetRcmConfig::class);
        $config = $getRcmConfig->__invoke();

        if (!isset($config['session'])) {
            $sessionManager = new SessionManager();
            Container::setDefaultManager($sessionManager);

            return $sessionManager;
        }

        $session = $config['session'];

        $sessionConfig = $this->getSessionConfig(
            $serviceContainer,
            $session
        );

        $sessionStorage = $this->getSessionStorage(
            $serviceContainer,
            $session
        );

        $sessionSaveHandler = $this->getSessionSaveHandler(
            $serviceContainer,
            $session
        );

        $sessionManager = new SessionManager(
            $sessionConfig,
            $sessionStorage,
            $sessionSaveHandler
        );

        $this->setValidatorChain(
            $sessionManager,
            $serviceContainer,
            $session
        );

        Container::setDefaultManager($sessionManager);

        return $sessionManager;
    }
}
