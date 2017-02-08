<?php
namespace Mesd\PresentationBundle\Twig;

use \Twig_Extension_GlobalsInterface;

class GlobalExtension extends \Twig_Extension implements Twig_Extension_GlobalsInterface
{
    private $configs = [];

    public function __construct(array $configs = [])
    {
        $this->configs['mesd_presentation'] = $configs['globals'];
    }

    public function getGlobals()
    {
        return $this->configs;
    }

    public function getName()
    {
        return 'mesd_presentation_globals_extension';
    }
}
