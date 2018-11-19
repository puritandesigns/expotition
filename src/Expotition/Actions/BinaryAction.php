<?php

namespace Expotition\Actions;

use Expotition\Conditionals\ConditionalInterface;
use Expotition\Campaigns\AdventureInterface;
use Expotition\Messages\Messages;
use Expotition\Settings\SettingInterface;

final class BinaryAction implements ActionInterface, ConditionalInterface
{
    /** @var AdventureInterface */
    private $adventure;
    /** @var ConditionalCheckInterface|string */
    private $condition;
    /** @var ActionInterface */
    private $success_action;
    /** @var ActionInterface */
    private $failure_action;

    public function __construct(
        AdventureInterface $adventure,
        $condition,
        ActionInterface $success_action,
        ActionInterface $failure_action
    ) {
        $this->adventure = $adventure;
        $this->condition = $condition;
        $this->success_action = $success_action;
        $this->failure_action = $failure_action;
    }

    private function getConditionalAction(): ActionInterface
    {
        if ($this->evaluateCondition()) {
            return $this->success_action;
        }

        return $this->failure_action;
    }

    public function doAction(
        SettingInterface $current_setting,
        Messages $messages
    ): SettingInterface {
        return $this->getConditionalAction()->doAction(
            $current_setting,
            $messages
        );
    }

    public function evaluateCondition(): bool
    {
        if ($this->condition instanceof ConditionalCheckInterface) {
            return $this->condition->check($this->getAdventure());
        }

        return false;
    }

    public function getDescription(): string
    {
        return $this->getConditionalAction()->getDescription();
    }

    public function getAdventure(): AdventureInterface
    {
        return $this->adventure;
    }

    public function isDoable(): bool
    {
        return true;
    }
}
