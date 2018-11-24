<?php

namespace Expotition\Actions;

use Expotition\Campaigns\AdventureInterface;
use Expotition\Messages\Messages;
use Expotition\Settings\SettingInterface;

final class LeaveAction extends AbstractAction
{
    /** @var SettingInterface */
    private $location_to_enter;
    /** @var string */
    private $transition_message;

    public function __construct(
        AdventureInterface $adventure,
        string $description,
        SettingInterface $location_to_enter,
        string $transition_message = null
    ) {
        parent::__construct($adventure, $description);

        $this->location_to_enter = $location_to_enter;
        $this->transition_message = $transition_message;
    }

    public function doAction(
        SettingInterface $current_setting,
        Messages $messages
    ): SettingInterface {
        if (null !== $this->transition_message) {
            $messages->createAndAdd($this->transition_message);
        }

        return $this->location_to_enter;
    }
}
