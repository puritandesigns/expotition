<?php

namespace Expotition\Campaigns;

use Expotition\Messages\Messages;
use Expotition\Settings\SettingInterface;

final class Adventure implements AdventureInterface
{
    /** @var Events */
    private $events;

    public function __construct(
        Events $events = null
    ) {
        if (null === $events) {
            $events = new Events();
        }

        $this->events = $events;
    }

    public function doAction(
        SettingInterface $setting,
        int $action_id = null
    ): Transition {
        $messages = new Messages();

        if (null !== $action_id) {
            return $setting->doAction($action_id, $messages);
        }

        return new Transition($messages, $setting);
    }

    public function addEvent(string $event)
    {
        $this->events->add($event);
    }

    public function getEvents(): Events
    {
        return $this->events;
    }

    public function hasEventOccurred(string $event): bool
    {
        return $this->events->hasEventOccurred($event);
    }
}
