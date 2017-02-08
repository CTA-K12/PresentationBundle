<?php
namespace Mesd\PresentationBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Mesd\PresentationBundle\Model\Heartbeat;

class HeartbeatEvent extends Event
{
    const NAME = 'mesd_presentation.heartbeat.received';

    protected $heartbeat;

    public function __construct(Heartbeat $heartbeat)
    {
        $this->heartbeat = $heartbeat;
    }

    public function getHeartbeat()
    {
        return $this->heartbeat;
    }
}
