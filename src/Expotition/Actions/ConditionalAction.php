<?php

namespace Expotition\Actions;

use Expotition\Conditionals\ConditionalInterface;
use Expotition\Campaigns\AdventureInterface;
use Expotition\Messages\Messages;
use Expotition\Settings\SettingInterface;

final class ConditionalAction implements ActionInterface, ConditionalInterface
{
    /** @var ConditionalCheckInterface|string */
    private $condition;
    /** @var ActionInterface */
    private $action;
    /** @var AdventureInterface */
    private $adventure;

    public function __construct(
        AdventureInterface $adventure,
        $condition,
        ActionInterface $action
    ) {
        $this->condition = $condition;
        $this->action = $action;
        $this->adventure = $adventure;
    }

    public function getDescription(): string
    {
        return $this->action->getDescription();
    }

    public function getAdventure(): AdventureInterface
    {
        return $this->adventure;
    }

    public function doAction(
        SettingInterface $current_setting,
        Messages $messages
    ): SettingInterface
    {
        if ($this->evaluateCondition()) {
            return $this->action->doAction(
                $current_setting,
                $messages
            );
        }

        return $current_setting;
    }

    public function isDoable(): bool
    {
        return $this->evaluateCondition();
    }

    public function evaluateCondition(): bool
    {
        if ($this->condition instanceof ConditionalCheckInterface) {
            return $this->condition->check($this->adventure);
        }

        return false;
    }
}
