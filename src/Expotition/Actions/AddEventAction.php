<?php

namespace Expotition\Actions;

use Expotition\Campaigns\AdventureInterface;
use Expotition\Messages\Messages;
use Expotition\Settings\SettingInterface;

final class AddEventAction extends AbstractAction
{
    /** @var string */
    private $event;
    /** @var string */
    private $response;

    public function __construct(
        AdventureInterface $adventure,
        string $event,
        string $description = '',
        string $response = null
    ) {
        parent::__construct($adventure, $description);

        $this->event = $event;
        $this->response = $response;
    }

    public function doAction(
        SettingInterface $current_setting,
        Messages $messages
    ): SettingInterface {
        $this->getAdventure()->addEvent($this->event);

        if (null !== $this->response) {
            $messages->createAndAdd($this->response);
        }

        return $current_setting;
    }
}
