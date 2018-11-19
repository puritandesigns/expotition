<?php

namespace Expotition\Actions;

use Expotition\Aggregatable;
use Expotition\Campaigns\AdventureInterface;

final class Actions implements \Countable, \Iterator
{
    use Aggregatable;
    /** @var ActionInterface[] */
    private $actions;

    public function __construct(ActionInterface ...$actions)
    {
        $this->actions = $actions;
    }

    public function add(ActionInterface $action)
    {
        $this->actions[] = $action;
    }

    /**
     * @param int $index
     * @param AdventureInterface $adventure
     * @return ActionInterface
     * @throws InvalidActionException
     */
    public function get(
        int $index,
        AdventureInterface $adventure
    ): ActionInterface {
        if (
            ! isset($this->actions[$index]) ||
            (
                $this->actions[$index] instanceof ConditionalAction &&
                ! $this->actions[$index]->evaluateCondition()
            )
        ) {
            throw new InvalidActionException(
                'You cannot take that action.'
            );
        }

        return $this->actions[$index];
    }

    public function getList(): array
    {
        $list = [];

        $actions = $this->getPossibleActions();

        foreach ($actions as $action) {
            $list[] = $action->getDescription();
        }

        return $list;
    }

    public function getActions(): array
    {
        return $this->actions;
    }

    public function getPossibleActions(): Actions
    {
        if (! $this->hasConditionalActions()) {
            return $this;
        }

        $actions = new Actions();

        foreach ($this->actions as $action) {
            if ($action->isDoable()) {
                $actions->add($action);
            }
        }

        return $actions;
    }

    public function hasConditionalActions(): bool
    {
        foreach ($this->actions as $action) {
            if ($action instanceof ConditionalAction) {
                return true;
            }
        }

        return false;
    }

    protected function getAggregate(): array
    {
        return $this->actions;
    }
}
