<?php

namespace Mesd\PresentationBundle\Twig;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Twig_Extension;

class MesdPresentationConfigExtension extends Twig_Extension implements \Twig_Extension_GlobalsInterface
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

        foreach ($keys as $k => $v) {
            $params[str_replace('.', '_', $v)] = $this->container->getParameter($v);
        }

        return $params;
    }

    public function getName()
    {
        return 'mesd_presentation_config_extension';
    }
}
