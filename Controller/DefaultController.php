<?php

namespace Mesd\PresentationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

use Mesd\PresentationBundle\Model\Calendar;
use Mesd\PresentationBundle\Model\Chat;
use Mesd\PresentationBundle\Model\Heartbeat;
use Mesd\PresentationBundle\Model\Mail;
use Mesd\PresentationBundle\Model\Message;
use Mesd\PresentationBundle\Model\Notification;
use Mesd\PresentationBundle\Model\Task;
use Mesd\PresentationBundle\Model\User;

use Mesd\PresentationBundle\Event\CalendarEvent;
use Mesd\PresentationBundle\Event\ChatEvent;
use Mesd\PresentationBundle\Event\HeartbeatEvent;
use Mesd\PresentationBundle\Event\MailEvent;
use Mesd\PresentationBundle\Event\MessageEvent;
use Mesd\PresentationBundle\Event\NotificationEvent;
use Mesd\PresentationBundle\Event\TaskEvent;
use Mesd\PresentationBundle\Event\UserEvent;

use Symfony\Component\EventDispatcher\EventDispatcher;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MesdPresentationBundle:Default:index.html.twig');
    }

    public function calendarAction(Request $request)
    {
        $data = $request->request->all();

        $event = new CalendarEvent($calendar);

        $dispatcher = $this->get('event_dispatcher');

        $dispatcher->dispatch(UserEvent::NAME, $event);

        return new JsonResponse($event->getUser()->deserialize('json'));
    }

    public function chatAction(Request $request)
    {
        $data = $request->request->all();

        $event = new UserEvent($heartbeat);

        $dispatcher = $this->get('event_dispatcher');

        $dispatcher->dispatch(UserEvent::NAME, $event);

        return new JsonResponse($event->getUser()->deserialize('json'));
    }

    public function heartbeatAction(Request $request)
    {
        $data = $request->request->all();
        $heartbeat = new Heartbeat($data);

        $event = new HeartbeatEvent($heartbeat);

        $dispatcher = $this->get('event_dispatcher');

        $dispatcher->dispatch(HeartbeatEvent::NAME, $event);

        return new JsonResponse($event->getHeartbeat()->normalize());
    }

    public function mailAction(Request $request)
    {
        $data = $request->request->all();

        $event = new UserEvent($heartbeat);

        $dispatcher = $this->get('event_dispatcher');

        $dispatcher->dispatch(UserEvent::NAME, $event);

        return new JsonResponse($event->getUser()->deserialize('json'));
    }

    public function messageAction(Request $request)
    {
        $data = $request->request->all();

        $event = new UserEvent($heartbeat);

        $dispatcher = $this->get('event_dispatcher');

        $dispatcher->dispatch(UserEvent::NAME, $event);

        return new JsonResponse($event->getUser()->deserialize('json'));
    }

    public function notificationAction(Request $request)
    {
        $data = $request->request->all();

        $event = new UserEvent($heartbeat);

        $dispatcher = $this->get('event_dispatcher');

        $dispatcher->dispatch(UserEvent::NAME, $event);

        return new JsonResponse($event->getUser()->deserialize('json'));
    }

    public function taskAction(Request $request)
    {
        $data = $request->request->all();

        $event = new UserEvent($heartbeat);

        $dispatcher = $this->get('event_dispatcher');

        $dispatcher->dispatch(UserEvent::NAME, $event);

        return new JsonResponse($event->getUser()->deserialize('json'));
    }

    public function userAction(Request $request)
    {
        $data = $request->request->all();

        $event = new UserEvent($heartbeat);

        $dispatcher = $this->get('event_dispatcher');

        $dispatcher->dispatch(UserEvent::NAME, $event);

        return new JsonResponse($event->getUser()->deserialize('json'));
    }
}
