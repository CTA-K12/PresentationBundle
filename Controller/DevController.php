<?php

namespace MESD\Presentation\PresentationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DevController extends Controller
{
    // Renders the main layout page
    public function indexAction()
    {
        return $this->render('MESDPresentationPresentationBundle:Dev:index.html.twig', array());
    }

    // Renders the splash layout page, used for login and registration forms
    public function splashAction()
    {
        return $this->render('MESDPresentationPresentationBundle:Dev:splash.html.twig', array());
    }

    // Renders the sidebar, not accessible via routes, only by controller
    public function sidebarAction($menu, $options = array())
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
        return $this->render('MESDPresentationPresentationBundle:Dev:sidebar.html.twig', array(
            'menu' => $menu,
            'type' => $type
        ));
    }

    // Demo page shows all CSS found in application, not dependent on base or index.
    // Not available in production
    public function demoAction()
    {
        return $this->render('MESDPresentationPresentationBundle:Dev:demo.html.twig', array());
    }

    // Development of flexible model layout for use in responsive applications.
    // Not available in production
    public function flexAction()
    {
        return $this->render('MESDPresentationPresentationBundle:Dev:flex.html.twig', array());
    }

    // Collapse page shows operation of collapsing sidebar when passed parameters.
    // Not available in production
    public function collapseAction()
    {
        return $this->render('MESDPresentationPresentationBundle:Dev:collapse.html.twig', array());
    }

}
