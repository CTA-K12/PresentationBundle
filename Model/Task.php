<?php
/**
 * Task.php file
 *
 * File that contains the task model class
 *
 * Licence MIT
 * Copyright (c) 2016 Multnomah Education Service District <http://www.mesd.k12.or.us>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @filesource /src/Mesd/PresentationBundle/Model/Menu.php
 * @package    Mesd\PresentationBundle\Model
 * @copyright  2016 (c) Multnomah Education Service District <http://www.mesd.k12.or.us>
 * @license    <http://opensource.org/licenses/MIT> MIT
 * @author     Curtis G Hanson <chanson@mesd.k12.or.us>
 * @version    {@inheritdoc}
 */
namespace Mesd\PresentationBundle\Model;

/**
 * Task
 *
 * @package    Mesd\PresentationBundle\Model
 * @copyright  2016 (c) Multnomah Education Service District <http://www.mesd.k12.or.us>
 * @license    <http://opensource.org/licenses/MIT> MIT
 * @author     Curtis G Hanson <chanson@mesd.k12.or.us>
 * @since      0.2.0
 */
class Heartbeat
{
    private $id;

    private $color;

    private $progress;

    private $title;

    private $routeAlias;

    public function __construct($identifier, $title, $progress, $routeAlias = null, $color = null)
    {
        $this->id         = $id;
        $this->title      = $title;
        $this->progress   = $progress;
        $this->routeAlias = $routeAlias;
        $this->color      = $color;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setProgress($progress)
    {
        $this->progress = $progress;

        return $this;
    }

    public function getProgress()
    {
        return $this->progress;
    }

    public function setRouteAlias($routeAlias)
    {
        $this->routeAlias = $routeAlias;

        return $this;
    }

    public function getRouteAlias()
    {
        return $this->routeAlias;
    }

    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function getArray()
    {
        return [
            'id'          => $this->id,
            'title'       => $this->title,
            'progress'    => $this->progress,
            'route_alias' => $this->routeAlias,
            'color'       => $this->color,
        ];
    }

    public function getJson()
    {
        return json_encode($this->getArray());
    }
}
