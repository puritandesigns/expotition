<?php

namespace Tests;

use Expotition\Actions\ActionInterface;
use Expotition\Actions\Actions;
use Expotition\Actions\AddEventAction;
use Expotition\Actions\GetEquipmentAction;
use Expotition\Actions\LeaveAction;
use Expotition\Actions\MultiAction;
use Expotition\Actions\SimpleResponseAction;
use Expotition\Campaigns\Adventure;
use Expotition\Messages\Messages;
use Expotition\Settings\Setting;
use PHPUnit\Framework\TestCase;

class MultiActionTest extends TestCase
{
    public function test_action_executes_multiples()
    {
        $adventure = new Adventure();

        $location = new Setting(
            $adventure,
            'Location',
            'Description'
        );

        $simple_action = new SimpleResponseAction(
            'Simple',
            $adventure,
            'Simple Response'
        );

        $add_event_action = new AddEventAction(
            $adventure,
            'test-event',
            'Testing Event'
        );

        /** @var ActionInterface $multi_action */
        $multi_action = new MultiAction(
            $adventure,
            'MultiAction',
            new Actions($simple_action, $add_event_action)
        );

        $messages = new Messages();

        $multi_action->doAction($location, $messages);

        $this->assertTrue($adventure->hasEventOccurred('test-event'));

        $this->assertEquals(
            'Simple Response',
            $messages->current()->getMessage()
        );
    }

    public function test_multiaction_returns_new_location()
    {
        $adventure = new Adventure();

        $current = new Setting($adventure, 'Now', 'Now');
        $next = new Setting($adventure, 'Next', 'Next');

        $multi = new MultiAction($adventure, 'Multi', new Actions(
            new SimpleResponseAction('1', $adventure, '1'),
            new LeaveAction('Leave', $adventure, $next),
            new SimpleResponseAction('2', $adventure, '2')
        ));

        $changed = $multi->doAction($current, new Messages());

        $this->assertEquals($next, $changed);
    }
}
