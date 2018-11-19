<?php

namespace Expotition\Campaigns;

use Expotition\Settings\SettingInterface;

interface AdventureInterface
{
    public function doAction(
        SettingInterface $setting,
        int $action_id
    ): Transition;

    public function addEvent(string $event);

    public function getEvents(): Events;

    public function hasEventOccurred(string $event): bool;
}
