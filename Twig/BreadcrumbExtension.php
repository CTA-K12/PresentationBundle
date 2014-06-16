<?php
// Mesd/PresentationBundle/Twig/BreadcrumbExtension.php
namespace Mesd\PresentationBundle\Twig;

use Twig_Extension;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Router;

class BreadcrumbExtension extends Twig_Extension
{
    protected $container;
    protected $request;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('breadcrumb', array($this, 'breadcrumbFunction')),
        );
    }

    public function breadcrumbFunction()
    {
        // get the request
        $this->request = $this->container->get('request');

        // get the params of the route we requested
        $params = $this->container->get('router')->match($this->request->getPathInfo());
        print_r($params);
    }

    public function getName()
    {
        return 'breadcrumb_extension';
    }

}