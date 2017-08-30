<?php

namespace ZrcmsRcmCompatibility\RcmAdapter;

use Doctrine\Common\Util\Debug;
use Psr\Container\ContainerInterface;
use Zend\ServiceManager\Config;
use Zend\ServiceManager\ServiceManager;
use Zend\View\HelperPluginManager;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Resolver\AggregateResolver;
use Zend\View\Resolver\TemplatePathStack;

/**
 * @deprecated BC ONLY
 * @author     James Jervis - https://github.com/jerv13
 */
class GetRcmViewRenderer
{
    /**
     * @var ContainerInterface
     */
    protected $serviceManager;

    /**
     * Constructor.
     *
     * @param ServiceManager $serviceManager
     */
    public function __construct($serviceManager)
    {
        $this->serviceManager = $serviceManager;
    }

    /**
     * @return PhpRenderer
     */
    public function __invoke()
    {
        /** @var GetRcmConfig $getRcmConfig */
        $getRcmConfig = $this->serviceManager->get(GetRcmConfig::class);

        $config = $getRcmConfig->__invoke();

        $helperPluginManager = new HelperPluginManager($this->serviceManager);

        $viewHelperConfig = isset($config['view_helpers']) ? $config['view_helpers'] : [];

        (new Config($viewHelperConfig))->configureServiceManager($helperPluginManager);

        $renderer = new PhpRenderer();

        // Configure it:
        $resolver = new AggregateResolver();
        //        $resolver->attach(
        //            new TemplateMapResolver(include 'config/templates.php'),
        //            100
        //        );
        $resolver->attach(
            (new TemplatePathStack())
                ->setPaths($config['view_manager']['template_path_stack'])
        );
        $renderer->setResolver($resolver);

        $helperPluginManager->get('BasePath')->setBasePath('');

        $renderer->setHelperPluginManager(
            $helperPluginManager
        );

        // Inject:
        //$renderer = new ZendViewRenderer($renderer);

        return $renderer;
    }
}
