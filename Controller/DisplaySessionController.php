<?php

namespace Mesd\PresentationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DisplaySessionController extends Controller {
    public function sessionSidebarAction($size){
        $session = $this->get( 'session' );
        $session->set( 'mesdPresentationSidebar', $size);
        return new Response();
    }

    public function sessionHideSidebarLabelsAction(){
        $session = $this->get( 'session' );
        $session->set( 'mesdPresentationHideSidebarLabels', true);
        return new Response();
    }

    public function sessionShowSidebarLabelsAction(){
        $session = $this->get( 'session' );
        $session->set( 'mesdPresentationHideSidebarLabels', false);
        return new Response();
    }

}