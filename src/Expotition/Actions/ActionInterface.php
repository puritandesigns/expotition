<?php

namespace Expotition\Actions;

use Expotition\Campaigns\AdventureInterface;
use Expotition\Messages\Messages;
use Expotition\Settings\SettingInterface;

interface ActionInterface
{
    public function getDescription(): string;

    public function getAdventure(): AdventureInterface;

    public function doAction(
        SettingInterface $current_setting,
        Messages $messages
    ): SettingInterface;

    public function isDoable(): bool;
}
