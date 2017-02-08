<?php
/**
 * Heartbeat.php file
 *
 * File that contains the help wiki heartbeat model class
 *
 * Licence MIT
 * Copyright (c) 2014 Multnomah Education Service District <http://www.mesd.k12.or.us>
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @filesource /src/Mesd/PresentationBundle/Model/Menu.php
 * @package    Mesd\PresentationBundle\Model
 * @copyright  2014 (c) Multnomah Education Service District <http://www.mesd.k12.or.us>
 * @license    <http://opensource.org/licenses/MIT> MIT
 * @author     Curtis G Hanson <chanson@mesd.k12.or.us>
 * @version    {@inheritdoc}
 */
namespace Mesd\PresentationBundle\Model;

/**
 * Menu
 *
 * While the menu itself is not a modifiable object,
 * it exists as an object so the permission system can apply ACE
 * to users accessing it.
 *
 * @package    Mesd\PresentationBundle\Model
 * @copyright  2015 (c) Multnomah Education Service District <http://www.mesd.k12.or.us>
 * @license    <http://opensource.org/licenses/MIT> MIT
 * @author     Curtis G Hanson <chanson@mesd.k12.or.us>
 * @since      0.2.0
 */
class Heartbeat
{
    private $action;

    private $data = [];

    private $hasFocus;

    private $interval;

    private $screenId;

    public function __construct($data)
    {
        $this->action   = $data['action'];
        $this->hasFocus = $data['has_focus'];
        $this->interval = $data['interval'];
        $this->screenId = $data['screen_id'];

        if (!empty($data['data']))
        {
            $this->data = $data['data'];
        }

        return $this;
    }

    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function addData($key, $val)
    {
        $this->data[$key] = $val;

        return $this;
    }

    public function removeData($key)
    {
        if ($this->hasData($key))
        {
            unset($this->data[$key]);
        }

        return $this;
    }

    public function hasData($key)
    {
        if (in_array($key, $this->data))
        {
            return true;
        }

        return false;
    }

    public function setData($data)
    {
        $this->data = $data;

        return $this;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setHasFocus($hasFocus)
    {
        $this->hasFocus = $hasFocus;

        return $this;
    }

    public function getHasFocus()
    {
        return $this->hasFocus;
    }

    public function setInterval($interval)
    {
        $this->interval = $interval;

        return $this;
    }

    public function getInterval()
    {
        return $this->interval;
    }

    public function setScreenId($screenId)
    {
        $this->screenId = $screenId;

        return $this;
    }

    public function getScreenId()
    {
        return $this->screenId;
    }

    public function normalize()
    {
        return array(
            'action'    => $this->getAction(),
            'data'      => $this->getData(),
            'has_focus' => $this->getHasFocus(),
            'interval'  => $this->getInterval(),
            'screen_id' => $this->getScreenId(),
        );
    }
}
