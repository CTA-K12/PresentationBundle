<?php

namespace Mesd\PresentationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DocsController extends Controller
{
    // Renders the table of contents (toc)
    public function tocAction()
    {
        return $this->render('MesdPresentationBundle:Docs:toc.html.twig', array());
    }

    // Renders the grids page
    public function gridsAction()
    {
        return $this->render('MesdPresentationBundle:Docs:grids.html.twig', array());
    }

    // Renders the typography page
    public function typeAction()
    {
        return $this->render('MesdPresentationBundle:Docs:type.html.twig', array());
    }

    // Renders the tables page
    public function tablesAction()
    {
        return $this->render('MesdPresentationBundle:Docs:tables.html.twig', array());
    }

    // Renders the forms
    public function formsAction()
    {
        return $this->render('MesdPresentationBundle:Docs:forms.html.twig', array());
    }

    // Renders the calendar page
    public function calendarAction()
    {
        return $this->render('MesdPresentationBundle::calendar.html.twig', array());
    }

    // Renders the search results page (i.e. list), like a google search result page, but not
    public function listAction()
    {
        return $this->render('MesdPresentationBundle::list.html.twig', array());
    }

    // Renders the map page
    public function mapAction()
    {
        return $this->render('MesdPresentationBundle::map.html.twig', array());
    }

    // Renders the dashboard page
    public function dashboardAction()
    {
        return $this->render('MesdPresentationBundle::dashboard.html.twig', array());
    }

    // Renders the error page, such as 404 or 403
    public function errorAction()
    {
        return $this->render('MesdPresentationBundle::error.html.twig', array());
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
        return $this->render('MesdPresentationBundle::sidebar.html.twig', array(
            'route' => $route,
            'menu' => $menu,
            'type' => $type
        ));
    }
}
