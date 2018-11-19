<?php

namespace Tests;

use Expotition\Actions\ActionInterface;
use Expotition\Actions\Actions;
use Expotition\Actions\ConditionalAction;
use Expotition\Actions\ConditionalCheckInterface;
use Expotition\Actions\SimpleResponseAction;
use Expotition\Campaigns\Adventure;
use Expotition\Campaigns\AdventureInterface;
use PHPUnit\Framework\TestCase;

class ActionTest extends TestCase
{
    public function test_negative_condtional_action()
    {
        $adventure = new Adventure();

        $action = new ConditionalAction(
            $adventure,
            new class implements ConditionalCheckInterface {
                public function check(AdventureInterface $adventure): bool
                {
                    return $adventure->hasEventOccurred('nonexistent');
                }
            },
            new SimpleResponseAction('Test', $adventure, '')
        );

        $this->assertFalse($action->evaluateCondition());
    }

    public function test_has_not_check()
    {
        $canDoCheck = new class implements ConditionalCheckInterface
        {
            public function check(AdventureInterface $adventure): bool
            {
                return true;
            }
        };

        $adventure = new Adventure();

        $action = new \Expotition\Actions\ConditionalAction(
            $adventure,
            $canDoCheck,
            new \Expotition\Actions\SimpleResponseAction(
                'Talk to the Old Man',
                $adventure,
                'The Old Man holds the sword aloft and says, "It is dangerous to go alone! Take this."'
            )
        );

        $actions = new Actions($action);

        $this->assertTrue($action->evaluateCondition());

        /** @var ActionInterface $action */
        foreach ($actions as $action) {
            $this->assertTrue($action->isDoable());
        }
    }
}
