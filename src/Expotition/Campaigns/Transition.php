<?php

namespace Expotition\Campaigns;

use Expotition\Actions\Actions;
use Expotition\Messages\Messages;
use Expotition\Settings\SettingInterface;

final class Transition
{
    /** @var Messages */
    private $messages;
    /** @var SettingInterface */
    private $setting;

    public function __construct(
        Messages $messages,
        SettingInterface $setting
    ) {
        $this->messages = $messages;
        $this->setting = $setting;
    }

    public function getSetting(): SettingInterface
    {
        return $this->setting;
    }

    public function getMessages(): Messages
    {
        return $this->messages;
    }

    public function getActions(): Actions
    {
        return $this->setting->getActions();
    }
}
