<?php
namespace Mesd\PresentationBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Mesd\PresentationBundle\Model\Calendar;

class CalendarEvent extends Event
{
    const NAME = 'mesd_presentation.calendar.load';

    protected $Calendar;

    public function __construct(Calendar $calendar)
    {
        $this->calendar = $calendar;
    }

    public function getCalendar()
    {
        return $this->calendar;
    }
}
