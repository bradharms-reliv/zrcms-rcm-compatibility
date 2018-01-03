<?php

namespace ZrcmsRcmCompatibility\RcmAdapter;

use Psr\Container\ContainerInterface;
use Rcm\Plugin\BaseController;
use Rcm\Plugin\PluginInterface;

/**
 * @deprecated BC ONLY
 * @author James Jervis - https://github.com/jerv13
 */
class GetRcmPluginController
{
    /**
     * @var ContainerInterface
     */
    protected $serviceManager;

    /**
     * Constructor.
     *
     * @param ContainerInterface|\Interop\Container\ContainerInterface $serviceManager
     */
    public function __construct($serviceManager)
    {
        $this->serviceManager = $serviceManager;
    }

    /**
     * @param $pluginName
     *
     * @return mixed|BaseController
     * @throws \Exception
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function __invoke($pluginName)
    {
        /*
         * Deprecated.  All controllers should come from the controller manager
         * now and not the service manager.
         *
         * @todo Remove if statement once plugins have been converted.
         */
        if ($this->serviceManager->has($pluginName)) {
            $serviceManager = $this->serviceManager;
        } else {
            $serviceManager = $this->serviceManager->get('ControllerLoader');
        }

        if (!$serviceManager->has($pluginName)) {
            return new BaseController(
                $this->serviceManager->get('config'),
                $pluginName,
                $this->serviceManager
            );

            //throw new \Exception(
            //    "Plugin $pluginName is not loaded or configured. Check
            //config/application.config.php"
            //);
        }

        $pluginController = $serviceManager->get($pluginName);

        //Plugin controllers must implement this interface
        if (!$pluginController instanceof PluginInterface) {
            throw new \Exception(
                'Class "' . get_class($pluginController) . '" for plugin "'
                . $pluginName . '" does not implement '
                . '\Rcm\Plugin\PluginInterface'
            );
        }

        return $pluginController;
    }
}
