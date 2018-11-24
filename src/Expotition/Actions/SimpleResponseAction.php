<?php

namespace Expotition\Actions;

use Expotition\Campaigns\AdventureInterface;
use Expotition\Messages\Messages;
use Expotition\Settings\SettingInterface;

final class SimpleResponseAction extends AbstractAction
{
    /** @var string */
    private $response;

    public function __construct(
        AdventureInterface $adventure,
        string $description,
        string $response
    ) {
        parent::__construct($adventure, $description);

        $this->response = $response;
    }

    public function doAction(
        SettingInterface $current_setting,
        Messages $messages
    ): SettingInterface {
        $messages->createAndAdd($this->response);

        return $current_setting;
    }
}
