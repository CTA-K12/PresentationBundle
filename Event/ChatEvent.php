<?php
namespace Mesd\PresentationBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Mesd\PresentationBundle\Model\Chat;

class ChatEvent extends Event
{
    const NAME = 'mesd_presentation.chat.load';

    protected $Chat;

    public function __construct(Chat $chat)
    {
        $this->chat = $chat;
    }

    public function getChat()
    {
        return $this->chat;
    }
}
