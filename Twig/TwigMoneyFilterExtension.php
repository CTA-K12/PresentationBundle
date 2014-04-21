<?php
// Mesd/PresentationBundle/Twig/TwigMoneyFilterExtension.php
namespace Mesd\PresentationBundle\Twig;

use Twig_Extension;

class TwigMoneyFilterExtension extends Twig_Extension
{
    public function getFilters()
    {
        /**
         * @param precision
         * @param scale
         * @param decimal
         * @param thousands
         * @param prefix
         * @param prefix_left // left, space, nospace
         * @param suffix
         * @param suffix_right // right, space, nospace
        ***/
        return array(
            //'text' => new Text(),
            'appabbrev' = 'MESD',
        );
    }

    public function getName()
    {
        return 'twig_money_filter_extension';
    }
}
