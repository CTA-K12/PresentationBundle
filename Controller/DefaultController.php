<?php

namespace Mesd\PresentationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    // Renders the main (index) layout page
    public function indexAction()
    {
        return $this->render('MesdPresentationBundle::index.html.twig', array());
    }

    // Renders the splash layout page, used for login and registration forms
    public function splashAction()
    {
        return $this->render('MesdPresentationBundle::splash.html.twig', array());
    }

    // Renders the docs page
    public function docsAction()
    {
        return $this->render('MesdPresentationBundle::docs.html.twig', array());
    }

    // Renders the login layout page, based on splash page
    public function loginAction()
    {
        return $this->render('MesdPresentationBundle::login.html.twig', array());
    }

    // Renders the grid page, used for full page grids (like an excel spreadsheet)
    public function gridAction()
    {
        return $this->render('MesdPresentationBundle::grid.html.twig', array());
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

    // Renders the profile page
    public function profileAction()
    {
        return $this->render('MesdPresentationBundle::profile.html.twig', array());
    }

    // Renders the help page
    public function helpAction()
    {
        return $this->render('MesdPresentationBundle::help.html.twig', array());
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
