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
    private $location;

    public function __construct(
        Messages $messages,
        SettingInterface $location
    ) {
        $this->messages = $messages;
        $this->location = $location;
    }

    public function getLocation(): SettingInterface
    {
        return $this->location;
    }

    public function getMessages(): Messages
    {
        return $this->messages;
    }

    public function getActions(): Actions
    {
        return $this->location->getActions();
    }
}
