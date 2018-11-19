<?php

namespace Expotition\Actions;

use Expotition\Campaigns\AdventureInterface;
use Expotition\Messages\Messages;
use Expotition\Settings\SettingInterface;

class AddEventAction extends AbstractAction
{
    /** @var string */
    private $event;

    public function __construct(
        AdventureInterface $adventure,
        string $event,
        string $description = ''
    ) {
        parent::__construct($description, $adventure);

        $this->event = $event;
    }

    public function doAction(
        SettingInterface $current_setting,
        Messages $messages
    ): SettingInterface {
        $this->getAdventure()->addEvent($this->event);

        if ('' !== $this->getDescription()) {
            $messages->createAndAdd($this->getDescription());
        }

        return $current_setting;
    }
}
