<?php
// MESDPresentation/PresentationBundle/Twig/HighlighterExtension.php
namespace MESD\Presentation\PresentationBundle\Twig;

use Twig_Extension;

class HighlighterExtension extends Twig_Extension
{

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('highlight', array($this, 'highlightFilter')),
        );
    }

    public function highlightFilter($subject, $pattern = null, $color = '#ff0')
    {
        if(!empty($pattern)){
            $pattern = '/(' . $pattern . ')/';
        }
        else{
            $pattern = '/(.*)/';
        }
        $replacement = '<mark style="background-color:' . $color . '">${1}</mark>';
        
        $newSubject = preg_replace($pattern, $replacement, $subject);
        
        echo $newSubject;
    }

    public function getName()
    {
        return 'highlighter_extension';
    }

}