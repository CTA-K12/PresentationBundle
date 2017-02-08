<?php
namespace Mesd\PresentationBundle\Twig;

class BoxExtension extends \Twig_Extension
{
    const BLOCK_HTML_A  = 'a';
    const BLOCK_HTML_UL = 'ul';
    const BLOCK_HTML_OL = 'ol';
    const BLOCK_HTML_LI = 'li';

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
            new \Twig_SimpleFunction('a',  [$this, 'aFunction'],  $templateVars),
            new \Twig_SimpleFunction('ul', [$this, 'ulFunction'], $templateVars),
            new \Twig_SimpleFunction('ol', [$this, 'olFunction'],   $templateVars),
            new \Twig_SimpleFunction('li', [$this, 'liFunction'], $templateVars),
        ];
    }

    /**
     * a Function (anchor tag)
     *
     * usage:
     *     {{ a({'id': '', 'class': ''}) }}
     *
     * @param  \Twig_Environment $twig [description]
     * @param  array             $opts [description]
     * @return [type]                  [description]
     */
    public function aFunction(\Twig_Environment $twig, $link = '#', array $opts = [])
    {
        $template = $twig->loadTemplate($this->template);

        return $template->renderBlock(self::BLOCK_HTML_A, [
            'link'  => $link,
            'attrs' => $opts,
        ]);
    }

    public function getName()
    {
        return 'mesd_presentation_box_extension';
    }

}
