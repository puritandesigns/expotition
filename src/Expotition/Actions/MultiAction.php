<?php

namespace Expotition\Actions;

use Expotition\Campaigns\AdventureInterface;
use Expotition\Messages\Messages;
use Expotition\Settings\SettingInterface;

final class MultiAction implements ActionInterface
{
    /** @var string */
    private $description;
    /** @var AdventureInterface */
    private $adventure;
    /** @var Actions */
    private $actions;

    public function __construct(
        AdventureInterface $adventure,
        string $description,
        Actions $actions
    ) {
        $this->adventure = $adventure;
        $this->description = $description;
        $this->actions = $actions;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getAdventure(): AdventureInterface
    {
        return $this->adventure;
    }

    public function doAction(
        SettingInterface $setting,
        Messages $messages
    ): SettingInterface {
        /** @var ActionInterface $action */
        foreach ($this->actions as $action) {
            $setting = $action->doAction($setting, $messages);
        }

        return $setting;
    }

    public function isDoable(): bool
    {
        return true;
    }
}
