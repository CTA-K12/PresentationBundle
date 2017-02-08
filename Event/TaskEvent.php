<?php
namespace Mesd\PresentationBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Mesd\PresentationBundle\Model\Task;

class TaskEvent extends Event
{
    const NAME = 'mesd_presentation.task.load';

    protected $Task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function getTask()
    {
        return $this->task;
    }
}
