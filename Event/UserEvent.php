<?php
namespace Mesd\PresentationBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Mesd\PresentationBundle\Model\User;

class UserEvent extends Event
{
    const NAME = 'mesd_presentation.user.load';

    protected $User;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getUser()
    {
        return $this->user;
    }
}
