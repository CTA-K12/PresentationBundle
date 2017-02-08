<?php
namespace Mesd\PresentationBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Mesd\PresentationBundle\Model\Message;

class MessageEvent extends Event
{
    const NAME = 'mesd_presentation.message.load';

    protected $Message;

    public function __construct(Message $message)
    {
        $this->message = $message;
    }

    public function getMessage()
    {
        return $this->message;
    }
}
