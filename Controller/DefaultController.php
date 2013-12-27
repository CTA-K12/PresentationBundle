<?php

namespace MESD\Presentation\PresentationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    // Renders the main layout page
    public function indexAction()
    {
        return $this->render('MESDPresentationPresentationBundle::index.html.twig', array());
    }

    // Renders the splash layout page, used for login and registration forms
    public function splashAction()
    {
        return $this->render('MESDPresentationPresentationBundle::splash.html.twig', array());
    }

    // Renders the demo layout page
    public function demoAction()
    {
        return $this->render('MESDPresentationPresentationBundle::demo.html.twig', array());
    }


    // Renders the sidebar, not accessible via routes, only by controller
    public function sidebarAction($route, $menu, $options = array())
    {
        $type = 'default';
        if(isset($options['type'])){
            switch ($options['type']) {
                case 'inline':
                    $type = 'inline';
                    break;
                case 'dropdown':
                    $type = 'dropdown';
                    break;
                case 'default':
                default:
                    $type = 'default';
                    break;
            }
        }
        return $this->render('MESDPresentationPresentationBundle::sidebar.html.twig', array(
            'route' => $route,
            'menu' => $menu,
            'type' => $type
        ));
    }
}
