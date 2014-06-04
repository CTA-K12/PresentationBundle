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

    // Renders the forms page
    public function formsAction()
    {
        return $this->render('MesdPresentationBundle:Docs:forms.html.twig', array());
    }

    // Renders the buttons page
    public function buttonsAction()
    {
        return $this->render('MesdPresentationBundle:Docs:buttons.html.twig', array());
    }

    // Renders the image page
    public function imgAction()
    {
        return $this->render('MesdPresentationBundle:Docs:img.html.twig', array());
    }

    // Renders the helper classes page
    public function helpersAction()
    {
        return $this->render('MesdPresentationBundle:Docs:helpers.html.twig', array());
    }

    // Renders the icons page
    public function iconsAction()
    {
        return $this->render('MesdPresentationBundle:Docs:icons.html.twig', array());
    }

    // Renders the navs page
    public function navsAction()
    {
        return $this->render('MesdPresentationBundle:Docs:navs.html.twig', array());
    }

    // Renders the breadcrumbs page
    public function breadcrumbsAction()
    {
        return $this->render('MesdPresentationBundle:Docs:breadcrumbs.html.twig', array());
    }

    // Renders the labels & badges page
    public function labelsAction()
    {
        return $this->render('MesdPresentationBundle:Docs:labels.html.twig', array());
    }
}