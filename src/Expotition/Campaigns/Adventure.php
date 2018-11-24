<?php

namespace Expotition\Campaigns;

use Expotition\Messages\Messages;
use Expotition\Settings\SettingInterface;

final class Adventure implements AdventureInterface
{
    /** @var string */
    private $title;
    /** @var string */
    private $slug;
    /** @var string */
    private $description;
    /** @var string */
    private $first_setting;
    /** @var Events */
    private $events;

    public function __construct(
        string $title,
        string $description,
        string $slug,
        string $first_setting,
        Events $events = null
    ) {
        $this->description = $description;
        $this->first_setting = $first_setting;
        $this->slug = $slug;
        $this->title = $title;

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

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getFirstSetting()
    {
        return $this->first_setting;
    }
}
