<?php
// Mesd/PresentationBundle/Twig/ParametersExtension.php
namespace Mesd\PresentationBundle\Twig;

use Twig_Extension;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ParametersExtension extends Twig_Extension
{
    protected $container;
    protected $pb;
    protected $param;


    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $pb = $this->container->getParameterBag();
        
        var_dump($pb);exit;
        //$this->param = $param;
    }

    /*public function getFunctions()
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
    }*/

    public function getName()
    {
        return 'parameters_extension';
    }

}