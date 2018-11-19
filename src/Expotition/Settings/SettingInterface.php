<?php

namespace Expotition\Settings;

use Expotition\Actions\ActionInterface;
use Expotition\Actions\Actions;
use Expotition\Campaigns\Transition;
use Expotition\Messages\Messages;

interface SettingInterface
{
    public function getTitle(): string;

    public function getDescription(): string;

    public function getActions(): Actions;

    public function getAction(int $index): ActionInterface;

    public function doAction(int $index, Messages $messages): Transition;
}
