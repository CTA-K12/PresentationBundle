<?php
// MESDPresentation/PresentationBundle/Twig/PlaceholderExtension.php
namespace MESDPresentation\PresentationBundle\Twig;

use Twig_Extension;

class PlaceholderExtension extends Twig_Extension
{

    const DEFAULT_W = 40;
    const DEFAULT_H = 40;
    const OFFSET    =  3;

    private $imgW;
    private $imgH;
    private $bgColor   = array();
    private $fgColor   = array();
    private $font;
    private $fontSize;
    private $pattern;
    private $angle;
    private $tooBig;

    public function __construct()
    {
        $this->bgColor = array('r' => 213, 'g' => 213, 'b' => 213);
        $this->fgColor = array('r' => 93, 'g' => 93, 'b' => 93);
        $this->font    = __DIR__ . '/../Resources/public/font/rockwell/ROCCB___.TTF';
        $this->pattern = '/\d+[x]\d+/';
        $this->angle   = 0;
        $this->tooBig  = false;
    }
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('placeholder', array($this, 'placeholderFilter')),
        );
    }

    public function placeholderFilter($size, $text = null)
    {
        
        preg_match($this->pattern, $size, $match);
        if(!empty($match) && is_array($match))
        {
            list($this->imgW, $this->imgH) = explode('x', $match[0]);
        }
        else
        {
            $this->imgW = self::DEFAULT_W;
            $this->imgH = self::DEFAULT_H;
        }

        $this->text = !is_null($text) ? $text : $this->imgW . 'x' . $this->imgH;

        $img        = imagecreate($this->imgW, $this->imgH);
        $bgColor    = imagecolorallocate($img, 213, 213, 213);
        $fgColor    = imagecolorallocate($img, 93, 93, 93);

        $this->setFontSize();
        $bBox = imageftbbox($this->fontSize, $this->angle, $this->font, $this->text);

        // the values calculated below are computed for asthetics
        // y values conventionally center the text awkwardly lower in the graphic
        // therefore the y centering is slightly higher
        $posX = ($this->imgW - ($bBox[2] - $bBox[0]))/2;
        $posY = ($this->imgH / 2) + ((abs($bBox[5]) + abs($bBox[1])) / 3);

        imagettftext($img, $this->fontSize, 0, $posX, $posY, $fgColor, $this->font, $this->text);

        ob_start();
        imagepng($img);
        $imgData = ob_get_contents();
        ob_end_clean();

        $imgData = base64_encode($imgData);
        imagecolordeallocate($img, $bgColor);
        imagecolordeallocate($img, $fgColor);
        imagedestroy($img);

        echo 'data:image/png;base64,' . $imgData;
    }

    public function getName()
    {
        return 'placeholder_extension';
    }

    private function getMaxSize($w, $h)
    {
        return $h <= $w ? $h : $w;
    }

    private function setFontSize()
    {
        // determine max size of image to constrain text
        $maxSize = $this->getMaxSize($this->imgW, $this->imgH);

        // the font size is the maxsize divided by an arbitrary offset
        $this->fontSize = true === $this->tooBig ? $this->fontSize - self::OFFSET : floor($maxSize / self::OFFSET);

        // get the text box size
        $bBox = imageftbbox($this->fontSize, $this->angle, $this->font, $this->text);

        // if the text box size is greater in width than the image
        // do this function again
        $textW = $bBox[2] - $bBox[0];
        $textH = $bBox[7] - $bBox[1];
        if($textW > $this->imgW || $textH > $this->imgH)
        {
            $this->tooBig = true;
            $this->setFontSize();
        }
        else
        {
            $this->tooBig = false;
        }
    }
}