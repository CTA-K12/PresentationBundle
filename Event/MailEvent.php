<?php
namespace Mesd\PresentationBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Mesd\PresentationBundle\Model\Mail;

class MailEvent extends Event
{
    const NAME = 'mesd_presentation.mail.load';

    protected $Mail;

    public function __construct(Mail $mail)
    {
        $this->mail = $mail;
    }

    public function getMail()
    {
        return $this->mail;
    }
}
