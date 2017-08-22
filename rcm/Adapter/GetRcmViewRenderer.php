<?php

namespace ZrcmsRcmCompatibility\Rcm\Adapter;

use Psr\Container\ContainerInterface;
use Zend\Expressive\ZendView\HelperPluginManagerFactory;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Resolver\AggregateResolver;
use Zend\View\Resolver\TemplatePathStack;

/**
 * @deprecated BC ONLY
 * @author James Jervis - https://github.com/jerv13
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
     * @param ContainerInterface|\Interop\Container\ContainerInterface $serviceManager
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
        $helperFactory = new HelperPluginManagerFactory();

        $helperPluginManager = $helperFactory->__invoke($this->serviceManager);

        $renderer = new PhpRenderer();

        $config = $this->serviceManager->get('config');

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
