<?php
// Mesd/PresentationBundle/Twig/IntervalExtension.php
namespace Mesd\PresentationBundle\Twig;

use Twig_Extension;

class IntervalExtension extends Twig_Extension
{

    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('diff', array($this, 'intervalFunction')),
        );
    }

    public function intervalFunction($dt1, $dt2, $format = null)
    {
        $dt1 = new \DateTime($dt1);
        $dt2 = new \DateTime($dt2);

        $interval = $dt2->diff($dt1);

        if(empty($format)){
            return $interval->format('%Y-%M-%D %H:%I:%S %R');
        }
        else{
            return $interval->format($format);
        }
    }

    public function getName()
    {
        return 'interval_extension';
    }
}