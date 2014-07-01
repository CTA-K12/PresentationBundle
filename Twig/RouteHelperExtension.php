<?php
// Mesd/PresentationBundle/Twig/RouteHelperExtension.php
namespace Mesd\PresentationBundle\Twig;

use Twig_Extension;
use Symfony\Component\DependencyInjection\ContainerInterface;


class RouteHelperExtension extends Twig_Extension
{

    protected $container;


    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }


    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('routeHelper', array($this, 'routeHelperFunction')),
        );
    }


    public function routeHelperFunction($input, $url = false)
    {
        $route = $this->container
                ->get('router')
                ->getRouteCollection()
                ->get($input);

        if (is_object($route)) {
            if ($url) {
                $path = $this->container->get('router')->generate($input, array(), true);
            }
            else {
                $path = $this->container->get('router')->generate($input);
            }
        }
        else {
            $path = $input;
        }

        return $path;
    }


    public function getName()
    {
        return 'routeHelper_extension';
    }

}