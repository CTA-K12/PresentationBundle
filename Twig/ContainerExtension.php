<?php
// Mesd/PresentationBundle/Twig/ContainerExtension.php
namespace Mesd\PresentationBundle\Twig;

use Twig_Extension;
use Symfony\Component\DependencyInjection\ContainerInterface;
//use Symfony\Component\Locale\Locale;


class ContainerExtension extends Twig_Extension
{
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getGlobals()
    {
        // Either just return the container available in templates, so to get parameters: {{ container.getParameter('param') }}
        // Whole container seems like overkill for now
        /*
        return array(
            'container' => $this->container,
        );
        */

        // OR make every parameter a twig global variable
        $params = $this->container->getParameterBag()->all();
        $params['container'] = $this->container;

        return $params;
    }

    public function getName()
    {
        return 'container_extension';
    }

}