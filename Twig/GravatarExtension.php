<?php
// Mesd/PresentationBundle/Twig/GravatarExtension.php
namespace Mesd\PresentationBundle\Twig;

use Twig_Extension;

class GravatarExtension extends Twig_Extension
{
    private $gravatarDomain = 'https://www.gravatar.com/avatar/';
    private $format     = '.jpg';
    private $size       = '?s=40';
    private $emailHash;
    private $request;

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('gravatar', array($this, 'gravatarFilter')),
        );
    }

    public function gravatarFilter($email, $size = NULL)
    {
        if($size) {
            $this->size = '?s=' . $size;
        }
        $this->emailHash = md5($email);
        $this->request   = $this->gravatarDomain . $this->emailHash . $this->format . $this->size;

        return $this->request;
    }

    public function getName()
    {
        return 'gravatar_extension';
    }
}