<?php

namespace Tests;

use Expotition\Actions\ConditionalAction;
use Expotition\Actions\ConditionalCheckInterface;
use Expotition\Actions\LeaveAction;
use Expotition\Actions\SimpleResponseAction;
use Expotition\Actions\Actions;
use Expotition\Campaigns\Adventure;
use Expotition\Campaigns\AdventureInterface;
use Expotition\Conditionals\ConditionalInterface;
use Expotition\Messages\Messages;
use PHPUnit\Framework\TestCase;
use Expotition\Settings\Setting;

class SettingTest extends TestCase
{
    public function test_get_description()
    {
        $location = $this->getLocation(new Adventure());

        $expected = 'You are in a single-room tavern.';

        $this->assertEquals($expected, $location->getDescription());
    }

    public function test_get_actions()
    {
        $actions = $this->getLocation(new Adventure())->getActions()->getList();

        $this->assertEquals([
            'Talk to Bartender',
            'Talk to Mysterious Elf',
            'Leave through The back door (North)',
            'Leave through The main door (South)',
        ], $actions);
    }

    /** @expectedException \Expotition\Actions\InvalidActionException */
    public function test_get_action_throws_exception()
    {
        $this->getLocation(new Adventure())->getAction(-5);
    }

    public function test_get_action()
    {
        $this->assertEquals(
            'Talk to Mysterious Elf',
            $this->getLocation(new Adventure())
                ->getAction(1)
                ->getDescription()
        );
    }

    public function test_leave_action_returns_new_location()
    {
        $adventure = new Adventure();
        $location = $this->getLocation($adventure);

        $this->assertEquals(
            'Out the back.',
            $location->getAction(2)
                ->doAction($location, new Messages())
                ->getDescription()
        );
    }

    public function test_conditional_action_doesnt_show()
    {
        $adventure = new Adventure();

        $location = new Setting(
            $adventure,
            'Tavern',
            'You are in a single-room tavern.',
            new Actions(
                new SimpleResponseAction(
                    'Talk to Bartender',
                    $adventure,
                    'The Bartender grunts, "What can I getcha?"'
                ),
                new ConditionalAction(
                    $adventure,
                    function() { return false; },
                    new SimpleResponseAction(
                        'Talk to Mysterious Elf',
                        $adventure,
                        'The Elf ignores you.'
                    )
                )
            )
        );

        /** @var ConditionalInterface $action */
        $actions = $location->getActions()->getPossibleActions();

        $this->assertCount(1, $actions);
    }

    public function test_conditional_action_shows_with_closure()
    {
        $adventure = new Adventure();
        $location = new Setting(
            $adventure,
            'Tavern',
            'You are in a single-room tavern.',
            new Actions(
                new SimpleResponseAction(
                    'Talk to Bartender',
                    $adventure,
                    'The Bartender grunts, "What can I getcha?"'
                ),
                new ConditionalAction(
                    $adventure,
                    new class implements ConditionalCheckInterface {
                        public function check(AdventureInterface $adventure): bool
                        {
                            return true;
                        }
                    },
                    new SimpleResponseAction(
                        'Talk to Mysterious Elf',
                        $adventure,
                        'The Elf ignores you.'
                    )
                )
            )
        );

        $this->assertEquals(2, $location->getActions()->count());

        $action = $location->getAction(1);
        $this->assertEquals(
            'Talk to Mysterious Elf',
            $action->getDescription()
        );

        $messages = new Messages();
        $action->doAction($location, $messages);

        $this->assertEquals(
            'The Elf ignores you.',
            $messages->current()->getMessage()
        );
    }

    private function getLocation(AdventureInterface $adventure): Setting
    {
        $north_location = new Setting($adventure, 'North', 'Out the back.');
        $south_location = new Setting($adventure, 'South', 'Out the front.');
        return new Setting(
            $adventure,
            'Tavern',
            'You are in a single-room tavern.',
            new Actions(
                new SimpleResponseAction(
                    'Talk to Bartender',
                    $adventure,
                    'The Bartender grunts, "What can I getcha?"'
                ),
                new SimpleResponseAction(
                    'Talk to Mysterious Elf',
                    $adventure,
                    'The Elf ignores you.'
                ),
                new LeaveAction(
                    'Leave through The back door (North)',
                    $adventure,
                    $north_location
                ),
                new LeaveAction(
                    'Leave through The main door (South)',
                    $adventure,
                    $south_location
                )
            )
        );
    }
}
