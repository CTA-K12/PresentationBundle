<?php

namespace Mesd\PresentationBundle\Twig;

use Twig_Extension;
use Symfony\Component\DependencyInjection\ContainerInterface;


class MesdPresentationConfigExtension extends Twig_Extension
{
    protected $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function getGlobals()
    {
        // Make MesdPresentationBundle config parameters into twig globals
        $keys = preg_grep(
                    '/^mesd_presentation/',
                    array_keys($this->container->getParameterBag()->all())
                );

        foreach ( $keys as $k => $v ) {
            $params[$v] = $this->container->getParameter($v);
        }

        return $params;
    }

    public function getName()
    {
        return 'mesd_presentation_config_extension';
    }

}