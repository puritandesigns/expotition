<?php

namespace Expotition\Campaigns;

use Expotition\Settings\SettingInterface;

interface AdventureInterface
{
    public function addEvent(string $event);

    public function doAction(
        SettingInterface $setting,
        int $action_id
    ): Transition;

    public function getEvents(): Events;

    public function getDescription(): string;

    public function getFirstSetting(): string;

    public function getSlug(): string;

    public function getTitle(): string;

    public function hasEventOccurred(string $event): bool;
}
