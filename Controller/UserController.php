<?php

namespace Mesd\PresentationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\EventDispatcher\EventDispatcher;

class UserController extends Controller
{
    public function loadAction(Request $request)
    {
        $data = $request->request->all();

        $event = new UserEvent($heartbeat);

        $dispatcher = $this->get('event_dispatcher');

        $dispatcher->dispatch(UserEvent::NAME, $event);

        return new JsonResponse($event->getUser()->deserialize('json'));
    }
}
