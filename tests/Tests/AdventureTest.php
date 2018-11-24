<?php

namespace Tests;

use Expotition\Actions\Actions;
use Expotition\Actions\CompleteQuestAction;
use Expotition\Actions\LeaveAction;
use Expotition\Actions\SimpleResponseAction;
use Expotition\Characters\Hero;
use Expotition\Messages\Messages;
use Expotition\Campaigns\Adventure;
use Expotition\Settings\Setting;

class AdventureTest extends \PHPUnit\Framework\TestCase
{
    /** @expectedException \Expotition\Campaigns\QuestSuccessException */
    public function test_adventure_completes()
    {
        $adventure = new Adventure(
            'Test',
            'Testing',
            'test',
            'test'
        );

        $forest = new Setting(
            $adventure,
            'Forest',
            'The sunlight blinds you as you step out of the cave. When your eyes adjust you see a lightly wooded forest.',
            'forest',
            new Actions(
                new CompleteQuestAction(
                    $adventure,
                    'Walk off into the sunset',
                    1
                )
            )
        );

        $dark_cave = new Setting(
            $adventure,
            'Dark Cave',
            'You wake up in a Dark Cave with two torches towards the middle.',
            'dark-cave',
            new Actions(
                new SimpleResponseAction(
                    $adventure,
                    'Talk to the Old Man',
                    'The Old Man holds the sword aloft and says, "It is dangerous to alone! Take this."'
                ),
                new SimpleResponseAction(
                    $adventure,
                    'Take the sword',
                    'You grip the hilt of the sword and hold it above your head. Da da da da!'
                ),
                new LeaveAction(
                    $adventure,
                    'Exit the cave',
                    $forest
                )
            )
        );

        $snapshot = $adventure->doAction($dark_cave, 2);
        $location = $snapshot->getSetting();
        $location->doAction(0, new Messages());
    }
}
