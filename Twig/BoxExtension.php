<?php
namespace Mesd\PresentationBundle\Twig;

class BoxExtension extends \Twig_Extension
{
    const BOX_START  = 'boxstart';
    const BOX_HEADER = 'boxheader';
    const BOX_BODY   = 'boxbody';
    const BOX_FOOTER = 'boxfooter';
    const BOX_END    = 'boxend';

    private $template;
    private $block;

    public function __construct($config)
    {
        $this->template = $config['templates']['box'];
    }

    public function getFunctions()
    {
        $templateVars = ['is_safe' => ['html'], 'needs_environment' => true];
        return [
            new \Twig_SimpleFunction('box_start',  [$this, 'boxStartFunction'],  $templateVars),
            new \Twig_SimpleFunction('box_header', [$this, 'boxHeaderFunction'], $templateVars),
            new \Twig_SimpleFunction('box_body',   [$this, 'boxBodyFunction'],   $templateVars),
            new \Twig_SimpleFunction('box_footer', [$this, 'boxFooterFunction'], $templateVars),
            new \Twig_SimpleFunction('box_end',    [$this, 'boxEndFunction'],    $templateVars),
        ];
    }

    public function boxStartFunction(\Twig_Environment $twig, $id, array $opts = [])
    {
        $template = $twig->loadTemplate($this->template);

        $params = ['id' => $id, 'opts' => $opts];

        return $template->renderBlock(self::BOX_START, $params);
    }

    public function boxEndFunction(\Twig_Environment $twig, array $opts = [])
    {
        $template = $twig->loadTemplate($this->template);

        $params = ['opts' => $opts];

        return $template->renderBlock(self::BOX_END, $params);
    }

    public function getName()
    {
        return 'mesd_presentation_box_extension';
    }

}
