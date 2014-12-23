<?php
// Mesd/PresentationBundle/Twig/BreadcrumbExtension.php
namespace Mesd\PresentationBundle\Twig;

use Twig_Extension;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Router;

class MesdPresentationIconExtension extends Twig_Extension
{
    const LIST_STACK    =  "<span class=\"fa fa-reorder fa-sub fa-fw\"></span>";
    const EDIT_STACK    =  "<span class=\"fa fa-pencil fa-sub fa-fw\"></span>";
    const NEW_STACK     =  "<span class=\"fa fa-plus fa-sub fa-fw\"></span>";
    const VIEW_STACK    =  "<span class=\"fa fa-search-plus fa-sub fa-fw\"></span>";

    public function __construct()
    {
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('stack', array($this, 'stackFilter')),
        );
    }

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('icon', array($this, 'iconFunction')),
        );
    }

    public function stackFilter($root, $type)
    {
        switch($type) {
            case "new" :
                $iconMod = self::NEW_STACK;
                break;
            case "edit" :
                $iconMod = self::EDIT_STACK;
                break;
            case "show" :
            case "view" :
                $iconMod = self::VIEW_STACK;
                break;
            case "index" ;
            case "list" :
                $iconMod = self::LIST_STACK;
                break;
            default :
                $iconMod = "";
                break;
        }

        return $root.$iconMod;
    }

    public function iconFunction($icon)
    {
        return '<span class="fa fa-'.$icon.'"></span>';
    }

    public function getName()
    {
        return 'icon_extension';
    }

}