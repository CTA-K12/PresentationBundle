<?php
namespace Mesd\PresentationBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Mesd\PresentationBundle\Model\Notification;

class NotificationEvent extends Event
{
    const NAME = 'mesd_presentation.notification.load';

    protected $Notification;

    public function __construct(Notification $notification)
    {
        $this->notification = $notification;
    }

    public function getNotification()
    {
        return $this->notification;
    }
}
